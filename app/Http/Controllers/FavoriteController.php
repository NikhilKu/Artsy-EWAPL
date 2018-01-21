<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;
use App\Http\Controllers\Controller;

/**
 * FavoriteController
 * 
 * Is able to remove and add favorite relations between user and researches.
 */
class FavoriteController extends Controller {

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'user_id' => 'required',
            'research_id' => 'required'
        ]);

        $favorite = new Favorite;
        $favorite->user_id = $request->input('user_id');
        $favorite->research_id = $request->input('research_id');
        $favorite->save();

        return redirect('/research/' . $request->input('research_id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $favorite = Favorite::find($id);
        $research_id = $favorite->research_id;
        $favorite->delete();
        return redirect('/research/' . $research_id);
    }

}
