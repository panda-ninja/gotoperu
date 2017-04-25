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
    return view('admin.index');
});

Route::get('admin/package', [
    'uses' => 'PackageController@create',
    'as' => 'package_create_path',
]);
Route::post('admin/new-package', [
    'uses' => 'PackageController@new',
    'as' => 'package_new_path',
]);
Route::post('/admin/mostrar_itinerario', [
    'uses' => 'ItinerariController@show_Itineraries',
    'as' => 'package_new_path',
]);