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
Route::post('/admin/guardar-paquete', [
    'uses' => 'PackageController@store',
    'as' => 'package_save_path',
]);
Route::get('/admin/destination', [
    'uses' => 'DestinationController@index',
    'as' => 'destination_index_path',
]);
Route::post('/admin/destination', [
    'uses' => 'DestinationController@store',
    'as' => 'destination_save_path',
]);
Route::post('/admin/destination/delete', [
    'uses' => 'DestinationController@delete',
    'as' => 'destination_delete_path',
]);
Route::post('/admin/destination/edit', [
    'uses' => 'DestinationController@edit',
    'as' => 'destination_edit_path',
]);
Route::get('storage/destination/{filename}', [
    'uses' => 'DestinationController@getDestinarionImageName',
    'as' => 'destination_image_path'
]);

Route::get('admin/catalog', [
    'uses' => 'PackageController@catalog',
    'as' => 'catalog_show_path',
]);
Route::get('admin/qoute', [
    'uses' => 'QouteController@index',
    'as' => 'qoute_show_path',
]);
Route::get('admin/qoute/proposal/{id}', [
    'uses' => 'QouteController@proposal',
    'as' => 'qoute_proposal_path',
]);
Route::get('admin/qoute/proposal/options/{id}', [
    'uses' => 'QouteController@options',
    'as' => 'qoute_options_path',
]);

/*== routes for services*/
Route::get('/admin/products', [
    'uses' => 'ServicesController@index',
    'as' => 'service_index_path',
]);
Route::post('/admin/products', [
    'uses' => 'ServicesController@store',
    'as' => 'service_save_path',
]);
Route::post('/admin/products/edit', [
    'uses' => 'ServicesController@edit',
    'as' => 'service_edit_path',
]);
Route::post('/admin/services/delete', [
    'uses' => 'ServicesController@delete',
    'as' => 'service_delete_path',
]);
/*== routes for costs*/
Route::get('/admin/costs', [
    'uses' => 'CostController@index',
    'as' => 'costs_index_path',
]);
Route::post('/admin/costs', [
    'uses' => 'CostController@store',
    'as' => 'costs_save_path',
]);
Route::post('/admin/costs/edit', [
    'uses' => 'CostController@edit',
    'as' => 'costs_edit_path',
]);
Route::post('/admin/costs/delete', [
    'uses' => 'CostController@delete',
    'as' => 'costs_delete_path',
]);

/*== rutas para proveedores*/
Route::any('admin/buscar-proveedor/', [
    'uses' => 'ProveedorController@autocomplete',
    'as' => 'buscar_proveedor_path',
]);
Route::post('/admin/provider', [
    'uses' => 'ProveedorController@store',
    'as' => 'provider_new_path',
]);
Route::get('/admin/provider',[
    'uses' => 'ProveedorController@index',
    'as' => 'provider_index_path',
]);
Route::post('/admin/provider/new', [
    'uses' => 'ProveedorController@store_new',
    'as' => 'provider_new_path',
]);
Route::post('/admin/provider/edit', [
    'uses' => 'ProveedorController@edit',
    'as' => 'provider_edit_path',
]);
Route::post('/admin/provider/delete', [
    'uses' => 'ProveedorController@delete',
    'as' => 'provider_delete_path',
]);

/*== rutas para itinerarios*/
Route::get('/admin/itinerary',[
    'uses' => 'ItinerariController@index',
    'as' => 'itinerari_index_path',
]);
Route::post('/admin/itinerary',[
    'uses' => 'ItinerariController@store',
    'as' => 'itinerary_save_path',
]);
Route::post('/admin/itinerary/edit',[
    'uses' => 'ItinerariController@edit',
    'as' => 'itinerary_edit_path',
]);

Route::post('/admin/itinerary/delete',[
    'uses' => 'ItinerariController@delete',
    'as' => 'itinerary_delete_path',
]);
Route::get('/admin/categories',[
    'uses' => 'CategoryController@show',
    'as' => 'category_index_path',
]);
Route::post('/admin/categories/new',[
    'uses' => 'CategoryController@store',
    'as' => 'category_save_path',
]);
Route::post('/admin/categories/edit',[
    'uses' => 'CategoryController@edit',
    'as' => 'category_edit_path',
]);
Route::post('/admin/categories/delete',[
    'uses' => 'CategoryController@delete',
    'as' => 'Category_delete_path',
]);
Route::get('admin/buscar-product/', [
    'uses' => 'ServicesController@autocomplete',
    'as' => 'buscar_service_path',
]);
Route::get('admin/quotes/new/', [
    'uses' => 'QouteController@nuevo',
    'as' => 'quotes_new_path',
]);
Route::post('/admin/quotes/store', [
    'uses' => 'PackageCotizacionController@store',
    'as' => 'package_cotizacion_save_path',
]);
Route::any('/admin/quotes/proposal/{id}/{id2}', [
    'uses' => 'PackageCotizacionController@options',
    'as' => 'new_plan_path',
]);
Route::post('/admin/guardar-cotizacion-paquete', [
    'uses' => 'PackageCotizacionController@store_package',
    'as' => 'cotizacion_package_save_path',
]);
Route::post('/admin/send-cotizacion', [
    'uses' => 'PackageCotizacionController@save_cotizacion',
    'as' => 'package_cotizacion_send_path',
]);
Route::get('/admin/current-quote', [
    'uses' => 'PackageCotizacionController@current_cotizacion',
    'as' => 'current-quote_path',
]);
Route::get('admin/buscar-cotizacion/', [
    'uses' => 'PackageCotizacionController@autocomplete',
    'as' => 'buscar_cotizacion_path',
]);
Route::post('admin/show-cotization/', [
    'uses' => 'PackageCotizacionController@show_cotizacion',
    'as' => 'cotizacion_show_path',
]);
Route::get('admin/show-cotization/{id}', [
    'uses' => 'PackageCotizacionController@show_cotizacion_id',
    'as' => 'cotizacion_id_show_path',
]);
Route::get('admin/sales_paxs_path/', [
    'uses' => 'PackageCotizacionController@show_paxs',
    'as' => 'sales_paxs_path',
]);
Route::post('admin/activar-package', [
    'uses' => 'PackageCotizacionController@activar_package',
    'as' => 'activar_package_path',
]);
Route::get('admin/quotes/{id}/pdf', [
    'uses' => 'PackageCotizacionController@pdf',
    'as' => 'quotes_pdf_path',
]);
//Route::get('storage/package-itinerary/{filename}', [
//    'uses' => 'PackageCotizacionController@getItineraryImageName',
//    'as' => 'package_itinerary_image_path'
//]);
Route::get('storage/itinerary/{filename}', [
    'uses' => 'ItinerariController@getItineraryImageName',
    'as' => 'itinerary_image_path'
]);
Route::post('admin/current-quotes/probabilidad', [
    'uses' => 'PackageCotizacionController@probabilidad',
    'as' => 'agregar_probabilidad_path'
]);
