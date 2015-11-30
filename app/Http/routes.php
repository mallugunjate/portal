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


Route::get('/documents', 'Document\DocumentController@index');



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


//profile routes
Route::get('/profile/create', 'Profile\ProfileController@create');
Route::post('/profile/store', 'Profile\ProfileController@store');
Route::delete('/profile/experience/{$experience}' , [ 'as'=>'experience.destroy' , 'uses'=>"Profile\ExperienceController@destroy"] );


//wireframes
//USER LOGIN AND SIGNUP
Route::get('wireframe', function() { return view('wireframes/index'); });
Route::get('wireframe/login', function() { return view('auth/login'); });
Route::get('wireframe/signup', function() { return view('auth/register'); });
Route::get('wireframe/reset', function() { return view('auth/passwordreset'); });
Route::get('wireframe/dashboard', function() { return view('wireframes/dashboard'); });




//FILES
//upload a file
Route::get('/admin/document/create', 'Document\DocumentAdminController@create');
Route::post('/admin/document/create', 'Document\DocumentAdminController@store');
//metadata
Route::get('/admin/document/add-meta-data', 'Document\DocumentAdminController@showMetaDataForm');
Route::post('/admin/document/add-meta-data', 'Document\DocumentAdminController@updateMetaData');
//delete a file
Route::delete('/admin/document/{id}', 'Document\DocumentAdminController@destroy');
//edit a file
Route::get('/admin/document/{id}/edit', 'Document\DocumentAdminController@edit');
Route::put('/admin/document/{id}', 'Document\DocumentAdminController@update');
//get a file
Route::get('/admin/document/{id}', 'Document\DocumentAdminController@show');


//FOLDERS
//add a folder
// Route::get('/admin/folder/create', 'Document\FolderAdminController@create');
// Route::post('/admin/folder/create', 'Document\FolderAdminController@store');
// Route::get('admin/folder/{id}/edit', 'Document\FolderAdminController@edit');
// Route::put('admin/folder/{id}', 'Document\FolderAdminController@update');
// Route::delete('/admin/folder/{id}', 'Document\FolderAdminController@destroy');
Route::resource('/admin/folder', 'Document\FolderAdminController');


//FOLDER STRUCTURE
//view folder structure
Route::get('/admin/folderstructure', 'Document\FolderStructureAdminController@index');
//define a folder relationship
Route::get('/admin/folderstructure/create', 'Document\FolderStructureAdminController@create');
Route::post('/admin/folderstructure/create', 'Document\FolderStructureAdminController@store');

//admin home
Route::get('/admin/home', 'Document\DocumentAdminController@index');

//view documents :: need to modify this
Route::get('/documents', 'Document\DocumentController@index');


//PACKAGES
Route::resource('/admin/package', 'Document\PackageController');

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




Route::get('/howyoulikemenow', function () {
    return view('site.howyoulikemenow');
});