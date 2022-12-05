<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TelefonoController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\HistorialClinicoController;
use App\Http\Controllers\DetalleClinicoController;
use App\Http\Controllers\VentaController;
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
Route::get('register','App\Http\Controllers\Auth\LoginController@redirecion');
Route::get('/', function () {
    return view('index');
});
Route::get('/fechaVacunacion', function () {
    return view('fechaVacunacion');
});
Route::post('/turnos/agregar', [App\Http\Controllers\TurnoController::class,'agregar']);
Route::post('turnos/mostrarTurno','App\Http\Controllers\TurnoController@mostrarTurno');
Route::get('/contacto', 'App\Http\Controllers\ContactoController@index');
Route::get('/seleccionTurno', [App\Http\Controllers\TurnoController::class,'indexTurno']);
/*Rutas login*/  
Route::get('/login', 'App\Http\Controllers\LoginController@index');
Route::get('/vistaRoles', 'App\Http\Controllers\Auth\VerificationController@vistaRoles');



Route::get('/login', 'App\Http\Controllers\LoginController@index');
Route::post('/registrado','App\Http\Controllers\Usuario@store');
Route::get('/registro/usuario','App\Http\Controllers\Usuario@create');



Route::group(['middleware' => 'auth'], function () {
    
   
    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');



    Route::get('/appblade', function () {
        return view('layouts.app');
    });

    Route::group(['middleware' => 'UsuarioCajero'], function () {

        Route::get('/vistaRoles/cajero', function () {
            return view('empresa.cajero.cajero');
        });
        Route::resource('/ventas','App\Http\Controllers\VentaController');
    /*Rutas articulos */
        Route::resource('/articulos','App\Http\Controllers\ArticuloController');
        Route::post('categorias/all','App\Http\Controllers\CategoriaController@all');
        Route::post('articulos/filter','App\Http\Controllers\ArticuloController@filter');
        Route::get('Lotes/{id}/Vencimientodelete','App\Http\Controllers\loteDescripcionController@Vencimientodelete');
    /*Rutas ventas*/
        Route::resource('/ventas','App\Http\Controllers\VentaController');
        
        Route::get("/precioEspecial/{id}", "App\Http\Controllers\VentaController@cambiarEstadoPrecio");
        Route::get("/agregarArticuloVenta/{id}", "App\Http\Controllers\VentaController@agregarArticuloVenta");
        Route::get("/eleminarUnArticuloVenta/{id}","App\Http\Controllers\VentaController@quitarUnArticuloVenta");
        Route::delete("/quitarArticuloDeVenta", "App\Http\Controllers\VentaController@quitarArticuloDeVenta")->name('quitarArticulo');
        Route::get("/cancelarVenta", "App\Http\Controllers\VentaController@cancelarVenta");
        Route::get("/terminarVenta", "App\Http\Controllers\VentaController@terminarVenta");
        Route::get("/ventas/total/{id}", "App\Http\Controllers\VentaController@ventasTotal")->name('ventasTotal');
        Route::post("/ventas/confirmarVenta/{id}", "App\Http\Controllers\VentaController@confirmarVenta");
    /*Rutas lote*/
        Route::get('Articulos/{id}/delete','App\Http\Controllers\ArticuloController@destroy');
        Route::resource('/lotes','App\Http\Controllers\loteDescripcionController');
        Route::get('/Lotes/{id}/delete','App\Http\Controllers\loteDescripcionController@destroy');
        Route::get('/Lotes/{id}/lote','App\Http\Controllers\loteDescripcionController@lote_For_Article');
        Route::get('/Lotes/{id}/create','App\Http\Controllers\loteDescripcionController@crear_por_id');
        Route::post('/Lotes/{id}/store','App\Http\Controllers\loteDescripcionController@store_por_id');
        Route::get('vencimientos','App\Http\Controllers\ArticuloController@Vencimiento')->name('vencimiento');
    /*Rutas historial de ventas */
        Route::get('historialVenta/index','App\Http\Controllers\ventaController@historialventas');
    /*Rutas de categoria */
        Route::resource('/categorias','App\Http\Controllers\categoriaController');
        Route::get('/quitarUnaCategoria/{id}','App\Http\Controllers\categoriaController@destroy');
    /* ruta de notificacion */
        Route::resource('/notificaciones','App\Http\Controllers\notificacionesController');
        Route::get('/notificacion/{id}/delete','App\Http\Controllers\notificacionesController@destroy');
    });


//-------------------------------------------------------------------------------------------------------
    Route::group(['middleware' => 'Usuario_Vet_pel'], function () {
             /*Rutas mascotas*/
            Route::get('/mascotas/verMascotasDeshabitadas','App\Http\Controllers\MascotaController@verBajaMascota');
            route::get('/mascotas/{id}/delete','App\Http\Controllers\MascotaController@destroy');
            Route::get('/mascotas/verMascota/{id}',[MascotaController::class,'verMascota'] )->name('verMascotas'); 
            Route::resource('/mascotas','App\Http\Controllers\MascotaController');
            Route::get('/mascotas/habilitar/{id}',[MascotaController::class,'habitarMascota'] );
            Route::get('/mascotas/create/{id}',[MascotaController::class, 'create'] )->name('crearMascota');

            /*Rutas turno peluquero y veterinario*/
            Route::post('/turnos/superpuesto','App\Http\Controllers\TurnoController@turnoSuperpuesto');
            
            Route::post('/turnos/darTurno/{id}','App\Http\Controllers\TurnoController@DarTurno');
            /*Rutas personas*/
            Route::resource('/personas','App\Http\Controllers\PersonaController');
            Route::get('/personas/{id}/delete','App\Http\Controllers\PersonaController@destroy');
            Route::get('/personas/estado/{id}','App\Http\Controllers\PersonaController@personasEstado');
            Route::get('/personas/{id}/habilitar','App\Http\Controllers\PersonaController@habilitarCliente');
            Route::get('/turnos/mostrar', [App\Http\Controllers\TurnoController::class,'show']);
            Route::get('turnos/cancelar/{id}',[TurnoController::class, 'cancelar'] )->name('cancelarTurno');  
            Route::resource('/turnos','App\Http\Controllers\TurnoController');
            Route::get('/tipoTurno/{id}',[App\Http\Controllers\TurnoController::class,'tipoTurno']);
            Route::get('/turnos/{id}/delete','App\Http\Controllers\TurnoController@destroy');
            Route::get('/turnos/mensaje/{id}', [App\Http\Controllers\TurnoController::class,'mensaje']);
            Route::resource('/telefonos','App\Http\Controllers\TelefonoController');
            Route::get('/telefonos/{id}/delete','App\Http\Controllers\TelefonoController@destroy');
            Route::post('telefono/ver','App\Http\Controllers\TelefonoController@ver');
            Route::get('telefonos/create/{id}',[TelefonoController::class, 'create'] )->name('creartelefono');

        });
//-------------------------------------------------------------------------------------------------------
Route::group(['middleware' => 'UsuarioVeterinario'], function () {
    Route::get('/vistaRoles/veterinario', function () {
        return view('empresa.veterinario.veterinario');
    });
    Route::resource('/historialesClinicos','App\Http\Controllers\HistorialClinicoController');
    Route::resource('/detallesClinicos','App\Http\Controllers\DetalleClinicoController');
    Route::get('DetallesClinicos/create/{id}',[DetalleClinicoController::class, 'create'] )->name('crearDetalleClinico');

});

//-------------------------------------------------------------------------------------------------------
Route::group(['middleware' => 'UsuarioPeluquero'], function () {

    Route::get('/vistaRoles/peluquero', function () {
        return view('empresa.peluquero.peluquero');
    });


});


    
    Route::get('/vistaRoles/peluquero', function () {
        return view('empresa.peluquero.peluquero');
    });
    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('/turnos/edit', function () {
        return view('turnos');
    });    
    /*ruta raza */
    Route::post('raza/ver','App\Http\Controllers\razaController@ver');
});

Route::group(['middleware' => 'UsuarioAdministrador'], function () {

    
    Route::get('/login/administrador', function () {
        return view('administrador.administrador');
    });
    Route::get('/login/administrador/vistas', function () {
        return view('administrador.vistas');
    });
    Route::get('/login/administrador/posteo', function () {
        return view('administrador.posteo');
    });


    Route::get('/usuario','App\Http\Controllers\Usuario@index');
    Route::get('/usuario/{id}/delete','App\Http\Controllers\Usuario@destroy');
    Route::get('/usuario/{id}/edit','App\Http\Controllers\Usuario@edit');
    Route::get('/usuario/{id}/editPassword','App\Http\Controllers\Usuario@editPassword');
    Route::post('/usuario/guardarPassword/{id}','App\Http\Controllers\Usuario@updatePassword');
    Route::post('/usuario/guardar/{id}','App\Http\Controllers\Usuario@update');
    
    Route::get('/usuario/Admin/ingresoAOtro/{id}','App\Http\Controllers\Usuario@CambioEstadoInicio');

});


/*vista administrador */



Route::get('/estadisticas', function () {
    return view('estadistica.estadisticas');
});


Auth::routes();
Route::get('logout','App\Http\Controllers\Auth\LoginController@logout');


Route::get('/estadistica/ganancia/por_mes/{id}','App\Http\Controllers\VentaController@gananciaPorMes');
Route::get('/estadistica/articulos/MasVendidos/{id}','App\Http\Controllers\VentaController@articulosMasVendidos');
Route::get('/estadistica/clientesNuevosPorMes/{id}','App\Http\Controllers\PersonaController@clientesNuevosPorMes');