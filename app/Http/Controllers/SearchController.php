<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use App\Research;

/**
 * SearchController
 * 
 * Manages the search operation of the site.
 */
class SearchController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (\Request::get('search') !== null) {
            $searching = "title";
            $searchQuery = \Request::get('search');
            $title = "Searching:  $searchQuery";
            $researches = Research::orderBy('id', 'desc')->where('title', 'like', '%' . $searchQuery . '%')->simplePaginate(18);
            return view('pages.search')->with("title", $title)->with("researches", $researches)->with("searchQuery", $searchQuery)->with("searching", $searching);
        } elseif (\Request::get('category') !== null) {
            $searching = "cat";
            $searchQuery = \Request::get('category');

            $researches = Research::orderBy('id', 'desc')->where('cat_id', $searchQuery)->simplePaginate(18);
            if (count(Category::find($searchQuery)) !== 0) {
                $cat_name = Category::find($searchQuery);
                $title = "Category:  $cat_name->cat_name";
                return view('pages.search')->with("title", $title)->with("researches", $researches)->with("searchQuery", $cat_name->cat_name)->with("searching", $searching);
            } else {
                return abort(404);
            }
        } else {
            return abort(404);
        }
    }

}
