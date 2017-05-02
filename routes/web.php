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
});
