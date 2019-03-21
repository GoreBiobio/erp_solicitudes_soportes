<?php
use App\Exports\ServicioExport;
use App\Exports\UsersExport;
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
//Route::get('notification', 'HomeController@notification');
route::get('/ingresar', 'pruebas@ingresar');
route::get('/seleccion', 'pruebas@seleccion');
route::get('/hola', 'pruebas@hola');
route::get('/pruebamodal', 'pruebas@mostrarAlgo');
route::get('/solicitaServicio', 'solicitud_servicio@solicitaServicio');
route::post('/ingresaSolicitudServicio', 'solicitud_servicio@ingresaSolicitudServicio');
route::post('/validarPin', 'solicitud_servicio@validarPin');
route::get('/recepcionarSolicitud', 'solicitudSoporte@recepcionaSolicitud');
route::post('/enviaCalificacion', 'solicitudSoporte@enviaCalificacion');
route::get('/dinamicos', 'pruebas@dinamicos');
route::get('/prueba', 'pruebas@algo');
//route::post('/recibeRun', 'pruebas@validarExisteUsuario');

route::post('/recibeSolicitud', 'solicitudSoporte@ingresaSolicitud');
route::post('/anulaSolicitudSoporte', 'solicitudSoporte@anularSolicitud');
route::post('/recibeSolicitudServicio', 'solicitudSoporte@enviaSolicitudServicio');
route::post('/anularSolicitudServicio', 'solicitudSoporte@anularSolicitudServicio');

route::get('/solicitudes', 'administrarSolicitudes@inicio');
route::post('/buscarSolicitud', 'administrarSolicitudes@buscaSolicitudes');
route::post('/admSolicitud', 'administrarSolicitudes@administar');
route::post('/enviaProfesional', 'administrarSolicitudes@asignarProdesional');





route::post('/recibeRun', 'inicio@recibirRut');
route::get('/recibeRun', 'pruebas@validarExisteUsuario');
route::get('/recibeRunInicio', 'inicio@volver_inicio');
route::get('/consulta_soportes_pedidos', 'inicio@mostrar_pedidos_soportes');
route::get('/consulta_soportes_terminados','inicio@mostrar_soportes_terminados');
route::get('/verDetalleSoporte','inicio@verDetalleSoporte');
route::get('/verDetalleSoporteTerminado','inicio@verDetalleSoporteTerminado');




route::get('/descargar2', 'pruebas@excel')->name('export_excel.excel');


Route::get('/descargar', function () {
	//return Excel::download(new ServicioExport(17), 'servicio.xlsx');
	return (new ServicioExport(17))->download('servicio.xlsx');
	

});

Route::get('/marca', function () {
	$marca = App\marca::all(); 
	dd($marca);
});

Route::get('/marca/{id}', function ($id){
	$marcass = App\Marca::where('marcas_idMarca','=',$id)->get();
	dd($marcass);


	$result = User::join('contacts', 'users.id',   '=', 'contacts.user_id')
	->join('orders', 'users.id', '=', 'orders.user_id')
	->select('users.id', 'contacts.phone', 'orders.price')
	->get();
	});



Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});

