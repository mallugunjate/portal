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

Route::pattern('storeno', '[0-9]+');
Route::pattern('id', '[0-9]+');

//STORE SELECTOR
Route::get('/', 'StoreSelectorController@index');

//DASHBOARD
Route::get('/{storeno}', array('uses' => 'Dashboard\DashboardController@index'));

//DOCUMENTS
Route::get('/{storeno}/document', array('uses' => 'Document\DocumentController@index'));

//CALENDAR
Route::get('/{storeno}/calendar', array('uses' => 'Calendar\CalendarController@index'));

//COMMUNICATIONS
Route::get('/{storeno}/communication', array('uses' => 'Communication\CommunicationController@index'));
Route::get('/{storeno}/communication/show/{id}', 'Communication\CommunicationController@show');
Route::resource('/communication', 'Communication\CommunicationTargetController');

//FEATURES
Route::get('/{storeno}/feature/show/{id}', 'Feature\FeatureController@show');

// Route::get('/home', function () {	
// 	return view('home');
// });

//Authentication Routes
Route::get('/admin/login', 'Auth\AuthController@getLogin');
Route::post('/admin/login', 'Auth\AuthController@postLogin');
Route::get('/admin/logout', 'Auth\AuthController@getLogout');

//Registration Routes
Route::get('/admin/register', 'Auth\AuthController@getRegister');
Route::post('/admin/register', 'Auth\AuthController@postRegister');
// Route::get('/activate/{activation_code}', 'Auth\AuthController@activateAccount');
// Route::get('/approve/{activation_code}', 'Auth\AuthController@approveAccount');


//Password reset routes
Route::controllers([
	'password' => 'Auth\PasswordController',
]);



//list of admin functions
// Route::get('/admin', function(){
// //	return view('admin.index');
// });

Route::get('/admin',  ['middleware' => 'admin.auth', 'uses' =>'AdminController@index' ] );

/* Admin Routes Begin 	*/

//admin home
Route::get('/admin/home',  ['middleware' => 'admin.auth', 'uses' =>'AdminController@index' ] );

//FILES
Route::get('/admin/document/add-meta-data', 'Document\DocumentAdminController@showMetaDataForm');
Route::post('/admin/document/add-meta-data', 'Document\DocumentAdminController@updateMetaData');
Route::get('/admin/document/manager',  ['middleware' => 'admin.auth', 'uses' =>'Document\DocumentManagerController@index' ] );

Route::resource('/admin/document', 'Document\DocumentAdminController');

//FOLDERS
Route::resource('/admin/folder', 'Document\FolderAdminController');

//PACKAGES
Route::resource('/admin/package', 'Document\PackageAdminController');

//FEATURES 
Route::resource('/admin/feature', 'Feature\FeatureAdminController');
Route::resource('/admin/featureOrder', 'Feature\FeatureOrderAdminController');

//Dasboard ADMIN
Route::resource('/admin/dashboard', 'Dashboard\DashboardAdminController');

//Communications
Route::resource('/admin/communication', 'Communication\CommunicationAdminController');

//CALENDAR ADMIN
Route::resource('/admin/calendar', 'Calendar\CalendarAdminController');

//Event Types
Route::resource('/admin/eventtypes', 'Calendar\EventTypesAdminController');

//Tags
Route::resource('/admin/tag', 'Tag\TagAdminController');

//Quicklinks
Route::resource('/admin/quicklinks', 'Dashboard\QuicklinksAdminController');

//Users
Route::resource('/admin/user', 'User\UserAdminController');

//Banner selector
Route::resource('/admin/banner' , 'AdminSelectedBannerController');

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