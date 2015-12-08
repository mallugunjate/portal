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

Route::get('/', 'Dashboard\DashboardController@index');


Route::get('/document', 'Document\DocumentController@index');



//Authentication Routes
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');


//Registration Routes
// Route::get('/auth/register', 'Auth\AuthController@getRegister');
Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');
Route::get('/activate/{activation_code}', 'Auth\AuthController@activateAccount');
Route::get('/approve/{activation_code}', 'Auth\AuthController@approveAccount');


//Password reset routes
Route::controllers([

	'password' => 'Auth\PasswordController',

]);


//list of admin functions
Route::get('/admin', function(){
	return view('admin.index');
});


//App routes
Route::get('/home', function () {	
	return view('home');
});

Route::get('/dashboard', 'Dashboard\DashboardController@index');

Route::get('/calendar', 'Calendar\CalendarController@index');


/* Admin Routes Begin 	*/

//admin home
Route::get('/admin/home', 'AdminController@index');


//FILES
Route::get('/admin/document/add-meta-data', 'Document\DocumentAdminController@showMetaDataForm');
Route::post('/admin/document/add-meta-data', 'Document\DocumentAdminController@updateMetaData');
Route::resource('/admin/document', 'Document\DocumentAdminController');
//metadata


//FOLDERS
Route::resource('/admin/folder', 'Document\FolderAdminController');

//PACKAGES
Route::resource('/admin/package', 'Document\PackageAdminController');

//Communications
Route::resource('/admin/communication', 'Communication\CommunicationAdminController');

//CALENDAR ADMIN
Route::resource('/admin/calendar', 'Calendar\CalendarAdminController');

//Event Types
Route::resource('/admin/eventtypes', 'Calendar\EventTypesAdminController');

//Tags
Route::resource('/admin/tag', 'Tag\TagAdminController');

/* API Routes */

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




Route::get('/howyoulikemenow', function () {
    return view('site.howyoulikemenow');
});