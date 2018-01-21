<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\School;

/**
 * SchoolController
 * 
 * Grants access to all schools known to the site.
 */
class SchoolController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index() {
        return School::all();
    }

}
