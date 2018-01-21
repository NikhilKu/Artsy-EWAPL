<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller {

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'content' => 'required|Min:10',
        ]);

        $id = $request->input('id');
        $comment = new Comment;
        $comment->content = $request->input('content');
        $comment->user_id = Auth::user()->id;
        $comment->research_id = $request->input('id');
        $comment->save();

        return redirect('/research/' . $id)->with('success', 'Comment posted');
    }

}
