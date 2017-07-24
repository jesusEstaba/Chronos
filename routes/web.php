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

	Route::resource('equipments', 'EquipmentController');
	Route::resource('equipmentcosts', 'EquipmentCostController');

	Route::resource('workforces', 'WorkforceController');
	Route::resource('workforcecosts', 'WorkforceCostController');

	Route::resource('partities', 'PartitieController');

	Route::resource('categories', 'CategoryController');

	Route::resource('projects', 'ProjectController');
	Route::resource('clients', 'ClientController');



	Route::resource('units', 'UnitController');
	
	Route::group(['prefix' => 'search'], function() {
	    Route::post('materials', 'SearchController@materials');
	    Route::post('equipments', 'SearchController@equipments');
	    Route::post('workforces', 'SearchController@workforces');
	    Route::post('partities', 'SearchController@partities');
	    Route::post('partitie', 'SearchController@partitie');
	});

	
	Route::get('projects/pdf/{id}', 'ProjectController@pdf');
	Route::get('projects/gantt/{id}', 'ProjectController@gantt');
	Route::get('projects/clone/{id}', 'ProjectController@clone');
	Route::post('search/{name}', 'SearchController@search');
	Route::resource('users', 'UserController');
});
