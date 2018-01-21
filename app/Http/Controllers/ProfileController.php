<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\School;

/**
 * ProfileController
 * 
 * Is able to add, edit and show profiles.
 */
class ProfileController extends Controller {

    /**
     * Display a profile page.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $currentProfile = Profile::where("user_id", $id)->first();
        $recentResearches = $currentProfile->research->sortByDesc('id');
        $title = "Profile of " . $currentProfile->name . " " . $currentProfile->surname;
        return view('pages.profile')->with("title", $title)
                        ->with("profile", $currentProfile)
                        ->with("recentResearches", $recentResearches);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $user_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id) {
        $this->validate($request, [
            'name' => 'required|max:45',
            'surname' => 'required|max:45',
            'biography' => 'required|max:2000',
            'school' => 'required',
            'birth' => 'required',
            'avatar' => 'image|nullable|max:1999'
        ]);

        // Handle file upload
        if ($request->hasFile('picture')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('picture')->getClientOriginalExtension();
            // Store filename
            $fileNameToStore = $filename . '' . time() . '.' . $extension;
            // Upload image
            $path = $request->file('picture')->storeAs('public/pictures', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $profile = Profile::where('user_id', $user_id)->first();
        $profile->name = $request->input('name');
        $profile->surname = $request->input('surname');
        $profile->biography = $request->input('biography');
        $profile->birth = $request->input('birth');
        $profile->school_id = $request->input('school');
        $profile->picture = $fileNameToStore;
        $profile->save();

        return redirect('/profile/' . $user_id);
    }

    public function edit($id) {
        $currentProfile = Profile::where("user_id", $id)->first();
        return view('pages.edit_profile')->with("title", "Edit Profile")
                        ->with("profile", $currentProfile)
                        ->with("schools", School::all());
    }

}
