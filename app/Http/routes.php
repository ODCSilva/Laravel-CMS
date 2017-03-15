<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::auth();
Route::get('dashboard/', 'HomeController@index');
Route::get('/', function () {
	$pages = App\Page::all();
	$css = App\CSSTemplate::where('active','=','1')->first();
	return view("welcome", compact('pages', 'css'));
});
Route::resource('page', 'FrontPageController');
Route::resource('article', 'FrontEndArticleController');
Route::resource('pagearticles', 'QtipController');
Route::resource('dashboard/articles', 'ArticlesController');
Route::resource('dashboard/pages', 'PagesController');
Route::resource('dashboard/csstemplates', 'CSSTemplatesController');
Route::resource('dashboard/privileges', 'PrivilegesController');
Route::resource('dashboard/contentareas', 'ContentAreasController');
Route::resource('dashboard/users', 'UsersController');
