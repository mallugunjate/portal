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
    return view('site.index');
});

//list of admin functions
Route::get('/admin', function(){
	return view('admin.index');
});

//FILES
//upload a file
Route::get('/admin/document/create', 'DocumentAdminController@create');
Route::post('/admin/document/create', 'DocumentAdminController@store');
//metadata
Route::get('/admin/document/add-meta-data', 'DocumentAdminController@showMetaDataForm');
Route::post('/admin/document/add-meta-data', 'DocumentAdminController@updateMetaData');
//delete a file
Route::delete('/admin/document/{id}', 'DocumentAdminController@destroy');
//edit a file
Route::get('/admin/document/{id}/edit', 'DocumentAdminController@edit');
Route::put('/admin/document/{id}', 'DocumentAdminController@update');
//get a file
Route::get('/admin/document/{id}', 'DocumentAdminController@show');


//FOLDERS
//add a folder
Route::get('/admin/folder/create', 'FolderAdminController@create');
Route::post('/admin/folder/create', 'FolderAdminController@store');
Route::get('admin/folder/{id}/edit', 'FolderAdminController@edit');
Route::put('admin/folder/{id}', 'FolderAdminController@update');
Route::delete('/admin/folder/{id}', 'FolderAdminController@destroy');


//FOLDER STRUCTURE
//view folder structure
Route::get('/admin/folderstructure', 'FolderStructureAdminController@index');
//define a folder relationship
Route::get('/admin/folderstructure/create', 'FolderStructureAdminController@create');
Route::post('/admin/folderstructure/create', 'FolderStructureAdminController@store');

//admin home
Route::get('/admin/home', 'DocumentAdminController@index');

//view documents :: need to modify this
Route::get('/documents', 'DocumentController@index');

//Api routes

//get navigation
Route::get('/api/v1/banner/{id}/navigation', 'Api\V1\ApiController@getNavigation');
//get files in folder : query parameter (boolean)isWeek e.g. ?isWeek=false 
Route::get('/api/v1/folder/{id}', 'Api\V1\ApiController@getDocumentsInFolder');
//get document by id
Route::get('/api/v1/document/{id}', 'Api\V1\ApiController@getDocumentById');
//get recent documents
Route::get('/api/v1/banner/{id}/document/recent/{days}', 'Api\V1\ApiController@getRecentDocuments');
//get all douments in a folder 
Route::get('/api/v1/folder/{id}/archived', 'Api\V1\ApiController@getArchivedDocuments');