<?php

namespace App\Http\Controllers;

/**
 * HomeController
 * 
 * Sends you back to the homepage, used for login and logout.
 */
class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('/');
    }

}
