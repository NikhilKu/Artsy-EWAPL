<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('pages/projectinfo', function () {
    $title = "Project Info";
    return view('pages.projectinfo')->with("title", $title);
});

Route::get('/research_pdf', function () {
	return view('pages.research_pdf');
});

Route::get('/research/{id}/exportPDF', 'ResearchController@exportPDF');

//Research pages
Route::resource('/', 'ResearchController');
Route::resource('/research', 'ResearchController');
Route::resource('/comment', 'CommentController');

//Favorite linking
Route::resource('unfavorite', 'FavoriteController');
Route::put('favorite', ['uses' => 'FavoriteController@store']);

//Profile page
Route::resource('/profile', 'ProfileController');

//Auth pages 
Auth::routes();

//Search pages
Route::resource('/search', 'SearchController');