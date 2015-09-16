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

Route::get('/', function () {
    return view('welcome');
});



//list of admin functions
Route::get('/admin', function(){
	return view('admin.index');
});
//upload a file
Route::get('/admin/document/create', 'DocumentAdminController@create');
Route::post('/admin/document/create', 'DocumentAdminController@store');
//add a folder
Route::get('/admin/folder/create', 'FolderAdminController@create');
Route::post('/admin/folder/create', 'FolderAdminController@store');