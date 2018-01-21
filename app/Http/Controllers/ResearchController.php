<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Research;
use App\School;
use App\Category;
use Illuminate\Support\Facades\Auth;
use PDF;
use DB;

/**
 * ResearchController
 * 
 * Accessed through routes to provide CRUD for researches.
 */
class ResearchController extends Controller {

    public function __construct() {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $title = "Research";
        $researches = Research::orderBy('id', 'desc')->simplePaginate(6);
        return view('pages.research')->with("title", $title)->with("researches", $researches);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $title = "Upload Research";
        $schools = School::all();
        $categorys = Category::all();
        return view('pages.upload')->with("title", $title)->with("schools", $schools)->with("categorys", $categorys);
    }

    /**
     * Splices the Youtube url to verify if it is a valid Youtube url.
     *
     * @param  int $url
     * @return modified $url
     */
    function youtubeID($url) {
        if (strlen($url) > 11) {
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
                return $match[1];
            } else {
                return false;
            }
        }

        return $url;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'summary' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        //  Image upload
        if ($request->hasFile('cover_image')) {
            // Get the filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get the filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Store the filename
            $fileNameToStore = $filename . '' . time() . '.' . $extension;
            // Upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $research = new Research;
        $research->title = $request->input('title');
        $research->summary = $request->input('summary');
        $research->content = $request->input('content');
        $research->type = $request->input('type');
        $research->user_id = Auth::user()->id;
        $youtube = $request->input('youtube_url');
        $embeddedUrl = $this->YoutubeID($youtube);
        $research->youtube_url = $embeddedUrl;
        $research->finished = $request->input('fin');
        $research->cat_id = $request->input('category_id');
        $research->cover_image = $fileNameToStore;
        $research->save();

        $id = $research->id;

        return redirect('/research/' . $id)->with('success', 'Research Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $research = Research::find($id);
        $title = $research->title;
        return view('pages.research_show')->with("title", $title)->with("research", $research);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $categorys = Category::all();
        $research = Research::find($id);

        if ($research->profile->user_id == Auth::user()->id) {
            $title = $research->title . ' Edit';
            return view('pages.edit_research')->with("title", $title)->with("research", $research)->with("categorys", $categorys);
        } else {
            return redirect('/research')->with('error', 'Sorry this is not your post');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'summary' => 'required',
        ]);

        // Image upload
        if ($request->hasFile('cover_image')) {
            // Get the filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get the filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Store the filename
            $fileNameToStore = $filename . '' . time() . '.' . $extension;
            // Upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        $research = Research::find($id);
        $research->title = $request->input('title');
        $research->summary = $request->input('summary');
        $research->content = $request->input('content');
        $research->type = $request->input('type');
        $research->user_id = Auth::user()->id;
        $youtube = $request->input('youtube_url');
        $embeddedUrl = $this->YoutubeID($youtube);
        $research->youtube_url = $embeddedUrl;
        $research->finished = $request->input('fin');
        if ($request->hasFile('cover_image')) {
            $research->cover_image = $fileNameToStore;
        }
        $research->cat_id = $request->input('category_id');
        $research->save();
        return redirect('/research/' . $id)->with('success', 'Research Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $research = Research::find($id);

        if ($research->profile->user_id == Auth::user()->id) {
            $research->delete();
            DB::table('comment')->where('research_id', '=', $research->id)->delete();
            DB::table('favorite')->where('research_id', '=', $research->id)->delete();
            return redirect('/')->with('success', 'Publication Removed');
        } else {
            return redirect('/research')->with('error', 'Sorry this is not your post');
        }
    }
    
    /**
	 * Returns a specific research in PDF format.
     *
     * @param  int $id
     * @return De publicatie als pdf.
     */
    public function exportPDF($id) {
        $research = Research::find($id);
        $pdf = PDF::loadView('pages.research_pdf', compact('research'));
        return $pdf->download('research.pdf');
    }

}
