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

Route::get('/', function () {
    return redirect()->to('login');
});

Route::get('login', 'LoginController@index');
Route::get('logout', 'LoginController@logout');
Route::post('login', 'LoginController@login');

Route::group(['middleware' => 'isAuth'], function() {
    Route::get('dashboard', 'DashboardController@index');

	Route::resource('user', 'UserController');
	Route::resource('materials', 'MaterialController');
	Route::resource('materialcosts', 'MaterialCostController');
	Route::get('materials/{id}/enabled', 'MaterialController@enabled');
	Route::get('materials/{id}/disabled', 'MaterialController@disabled');

	Route::resource('equipments', 'EquipmentController');
	Route::resource('equipmentcosts', 'EquipmentCostController');
	Route::get('equipments/{id}/enabled', 'EquipmentController@enabled');
	Route::get('equipments/{id}/disabled', 'EquipmentController@disabled');

	Route::resource('workforces', 'WorkforceController');
	Route::resource('workforcecosts', 'WorkforceCostController');
	Route::get('workforces/{id}/enabled', 'WorkforceController@enabled');
	Route::get('workforces/{id}/disabled', 'WorkforceController@disabled');

	Route::resource('partities', 'PartitieController');
	Route::get('partities/{id}/enabled', 'PartitieController@enabled');
	Route::get('partities/{id}/disabled', 'PartitieController@disabled');

	Route::resource('categories', 'CategoryController');

	Route::resource('projects', 'ProjectController');
	Route::get('projects/{id}/destroy', 'ProjectController@destroy');
	Route::get('projects/{id}/clone', 'ProjectController@clone');
	Route::get('projects/partities/{id}', 'ProjectController@partitiePDF');
	Route::get('projects/offer/{id}', 'ProjectController@offerPDF');
	Route::get('projects/gantt/{id}', 'ProjectController@gantt');
	Route::post('projects/gantt/{id}', 'ProjectController@saveGantt');

	Route::resource('clients', 'ClientController');
	Route::get('clients/{id}/enabled', 'ClientController@enabled');
	Route::get('clients/{id}/disabled', 'ClientController@disabled');


	Route::resource('units', 'UnitController');
	
	Route::group(['prefix' => 'search'], function() {
	    Route::post('materials', 'SearchController@materials');
	    Route::post('equipments', 'SearchController@equipments');
	    Route::post('workforces', 'SearchController@workforces');
	    Route::post('partities', 'SearchController@partities');
	    Route::post('partitie', 'SearchController@partitie');
	});

	
	
	Route::post('search/{name}', 'SearchController@search');
	Route::resource('users', 'UserController');
	Route::get('users/{id}/enabled', 'UserController@enabled');
	Route::get('users/{id}/disabled', 'UserController@disabled');
	
	Route::resource('configuration', 'ConfigurationController');
});
