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
Route::get('/crear',[
    'uses' => 'IndexController@crear',
    'as' => 'crear_path',
]);
Route::post('/crearp',[
    'uses' => 'IndexController@crearp',
    'as' => 'crear_p_path',
]);

Route::get('/',[
    'uses' => 'IndexController@inicio',
    'as' => 'inicio_path',
]);
Route::post('/login',[
    'uses' => 'UserAuthController@store',
    'as' => 'login_path',
]);



Route::get('/logout',[
    'uses' => 'UserAuthController@destroy',
    'as' => 'logout_path',
]);
Route::get('/ventas',[
    'uses' => 'IndexController@ventas',
    'as' => 'ventas_path',
]);
Route::get('/contabilidad', [
    'uses' => 'IndexController@contabilidad',
    'as' => 'contabilidad1_path',
]);
Route::get('/reservas', [
    'uses' => 'IndexController@reservas',
    'as' => 'reservas_path',
]);

Route::get('admin/',[
    'uses' => 'IndexController@index',
    'as' => 'index_path',
]);

Route::post('ventas/vista/',[
    'uses' => 'IndexController@ventas_now',
    'as' => 'ventas_now_path',
]);

Route::get('admin/',[
    'uses' => 'IndexController@index',
    'as' => 'index_path',
]);
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
Route::get('admin/quotes/new/profile', [
    'uses' => 'QouteController@nuevo1',
    'as' => 'quotes_new1_path',
]);

Route::post('/admin/quotes/store', [
    'uses' => 'PackageCotizacionController@store',
    'as' => 'package_cotizacion_save_path',
]);
Route::any('/admin/quotes/proposal/{id}/{id2}/{id3}', [
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


//

Route::get('/admin/current-quote/{page}', [
    'uses' => 'PackageCotizacionController@current_cotizacion_page',
    'as' => 'current_quote_page_path',
]);


//


Route::get('admin/buscar-cotizacion/', [
    'uses' => 'PackageCotizacionController@autocomplete',
    'as' => 'buscar_cotizacion_path',
]);
Route::post('admin/show-cotization/', [
    'uses' => 'PackageCotizacionController@show_cotizacion',
    'as' => 'cotizacion_show_path',
]);
//hidalgo
//client
Route::get('admin/pax/', [
    'uses' => 'QouteController@pax',
    'as' => 'pax_path',
]);
Route::get('admin/pax/{id}', [
    'uses' => 'QouteController@paxshow',
    'as' => 'pax_show_path',
]);
Route::post('admin/pax/payment', [
    'uses' => 'PaymentController@store',
    'as' => 'payment_store_path',
]);
Route::post('admin/pax/payment/update/{id}', [
    'uses' => 'PaymentController@update',
    'as' => 'payment_update_path',
]);
//RESERVAS
Route::get('admin/book', [
    'uses' => 'BookController@index',
    'as' => 'book_path',
]);
Route::get('admin/book/{id}', [
    'uses' => 'BookController@show',
    'as' => 'book_show_path',
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
Route::get('admin/current-quotes/plan/{id}', [
    'uses' => 'PackageCotizacionController@plan',
    'as' => 'mostar_planes_path'
]);
Route::post('admin/current-quotes/plan/elegido', [
    'uses' => 'PackageCotizacionController@escojer_precio_paquete',
    'as' => 'escojer_precio_paquete_path'
]);
Route::post('admin/current-quotes/enlatados', [
    'uses' => 'PackageCotizacionController@cargar_paquete_enlatados',
    'as' => 'crear_paquete_enlatados_path'
]);
Route::get('admin/current-quotes/new-plan/{id}', [
    'uses' => 'PackageCotizacionController@plan_newpackage',
    'as' => 'mostar_newpackage_path'
]);
Route::get('admin/itineraries', [
    'uses' => 'PackageController@itineraries',
    'as' => 'show_itineraries_path'
]);
Route::get('admin/itinerary/show/{id}', [
    'uses' => 'PackageController@show_itinerary',
    'as' => 'show_itinerary_path'
]);
Route::post('admin/package/edit/', [
    'uses' => 'PackageController@itinerary_edit',
    'as' => 'package_edit_path'
]);
Route::get('admin/itinerary/duplicate/{id}', [
    'uses' => 'PackageController@duplicate_itinerary',
    'as' => 'duplicate_package_path'
]);
Route::post('admin/itinerary/duplicate/', [
    'uses' => 'PackageController@itinerary_duplicate',
    'as' => 'package_duplicate_path'
]);
Route::post('/admin/package/delete', [
    'uses' => 'PackageController@delete',
    'as' => 'package_delete_path',
]);
Route::get('admin/package/{id}/pdf', [
    'uses' => 'PackageController@pdf',
    'as' => 'package_pdf_path',
]);
Route::get('admin/contabilidad/{id}', [
    'uses' => 'PackageCotizacionController@contabilidad',
    'as' => 'contabilidad_path',
]);
Route::post('/admin/book/id', [
    'uses' => 'BookController@asignar_proveedor',
    'as' => 'asignar_proveedor_path',
]);
Route::post('/admin/venta/categorizar', [
    'uses' => 'PackageCotizacionController@categorizar',
    'as' => 'categorizar_path',
]);
Route::get('admin/contabilidad', [
    'uses' => 'ContabilidadController@index',
    'as' => 'contabilidad_index_path',
]);
Route::get('/admin/contabilidad/show/{id}', [
    'uses' => 'ContabilidadController@show',
    'as' => 'contabilidad_show_path',
]);
Route::post('admin/contabilidad/conciliar-venta', [
    'uses' => 'ContabilidadController@confirmar',
    'as' => 'contabilidad_confirmar_path',
]);
Route::post('admin/contabilidad/conciliar-venta-h', [
    'uses' => 'ContabilidadController@confirmar_h',
    'as' => 'contabilidad_confirmar_h_path',
]);
Route::post('/admin/contabilidad/pagar', [
    'uses' => 'ContabilidadController@pagar',
    'as' => 'pagar_proveedor_path',
]);
Route::get('/admin/contabilidad/buscar/fechas/{desde}/{hasta}', [
    'uses' => 'ContabilidadController@listar',
    'as' => 'contabilidad_fechas_path',
]);
Route::post('/admin/contabilidad/buscar/fechas/', [
    'uses' => 'ContabilidadController@listar_post',
    'as' => 'contabilidad_fechas_post_path',
]);
Route::post('/admin/reservas/confirmar', [
    'uses' => 'BookController@confirmar',
    'as' => 'confirmar_reserva_path',
]);
Route::post('/admin/book/hotel', [
    'uses' => 'BookController@asignar_proveedor_hotel',
    'as' => 'asignar_proveedor_hotel_path',
]);
Route::post('/admin/ventas/hotel/traer-precios', [
    'uses' => 'CostController@mostrar_hotel',
    'as' => 'mostrar_precio_hotel_path',
]);
Route::post('/admin/products-edit', [
    'uses' => 'ServicesController@edit_hotel',
    'as' => 'hotel_edit_path',
]);
Route::post('/admin/services/delete', [
    'uses' => 'ServicesController@delete',
    'as' => 'service_delete_path',
]);
Route::post('/admin/costs/edit-hotel', [
    'uses' => 'CostController@edit_hotel',
    'as' => 'costs_edit_hotel_path',
]);
Route::post('/admin/cotizacion/delete', [
    'uses' => 'PackageCotizacionController@delete',
    'as' => 'cotizacion_delete_path',
]);
Route::post('/admin/contabilidad/pagar-hotel', [
    'uses' => 'ContabilidadController@pagar',
    'as' => 'pagar_proveedor_h_path',
]);
Route::post('/ventas/nuevo-paquete', [
    'uses' => 'PackageCotizacionController@nuevo_paquete',
    'as' => 'nuevo_paquete_path',
]);
Route::post('/ventas/new-cotizacion', [
    'uses' => 'PackageCotizacionController@editar_cotizacion1',
    'as' => 'editar_cotizacion1_path',
]);
Route::post('/ventas/save-new-package', [
    'uses' => 'PackageCotizacionController@guardar_paquete',
    'as' => 'save_new_package_path',
]);
Route::post('/ventas/nuevo-plantilla', [
    'uses' => 'PackageCotizacionController@nuevo_paquete_',
    'as' => 'nuevo_paquete_plantilla_path',
]);
Route::post('/admin/quotes/servicio/delete', [
    'uses' => 'PackageCotizacionController@delete_servicio_quotes_paso1',
    'as' => 'quotes_servicio_delete_path',
]);
Route::get('admin/current-quotes/plan/excel/{id}', [
    'uses' => 'PackageCotizacionController@plan_excel',
    'as' => 'mostar_planes_excel_path'
]);
Route::get('quotes/autocomplete', [
    'uses' => 'PackageCotizacionController@cotizacion_cliente_autocomplete',
    'as' => 'quotes_auto_path'
]);
Route::post('/admin/cliente/mostrar', [
    'uses' => 'PackageCotizacionController@mostrar_datos_cliente',
    'as' => 'quotes_cliente_mostrar_path'
]);
Route::get('/admin/quotes/new/{id}', [
    'uses' => 'PackageCotizacionController@nuevo_plan_cotizacion',
    'as' => 'new_plan_cotizacion_path'
]);
Route::get('/admin/quotes/new/step1/{cliente}/{coti_id}/{pqt_id}', [
    'uses' => 'PackageCotizacionController@show_step1',
    'as' => 'show_step1_path'
]);
Route::get('/admin/quotes/new/step1/{cliente}/{coti_id}/{pqt_id}/{id_serv}', [
    'uses' => 'PackageCotizacionController@show_step1_ser',
    'as' => 'show_step1_ser_path'
]);
Route::get('/admin/quotes/new/step2/{coti_id}/{pqt_id}/{imprimir}', [
    'uses' => 'PackageCotizacionController@show_step2',
    'as' => 'show_step2_path'
]);
//
Route::patch('/admin/quotes/new/step1/step1_edit/{id}', [
    'uses' => 'PackageCotizacionController@step1_edit',
    'as' => 'step1_edit_path'
])->where('id', '[0-9]+');

Route::post('/admin/quotes/hotel/delete', [
    'uses' => 'PackageCotizacionController@delete_hotel_quotes_paso1',
    'as' => 'quotes_hotel_delete_path',
]);
Route::get('/admin/pqt/escojer/{id}', [
    'uses' => 'PackageCotizacionController@escojer_pqt',
    'as' => 'escojer_pqt_plan',
]);
Route::post('/admin/reservas/add-code', [
    'uses' => 'PackageCotizacionController@add_cod_verif',
    'as' => 'add_cod_verif_path',
]);

Route::post('/admin/reservas/hotel/add-code', [
    'uses' => 'PackageCotizacionController@add_cod_hotel_verif',
    'as' => 'add_cod_verif_hotel_path',
]);

Route::post('/admin/curret/clonar', [
    'uses' => 'PackageCotizacionController@clonar_plan',
    'as' => 'generar_pantilla_path',
]);
Route::get('/admin/curret/clonar/{id}', [
    'uses' => 'PackageCotizacionController@clonar_plan_id',
    'as' => 'generar_pantilla_id_path',
]);