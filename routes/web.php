<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\ChoferController;
use App\Http\Controllers\CorridaController;
use App\Http\Controllers\PasajeroController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\DestinoController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WebhoocksController;
use App\Http\Controllers\PaymentsImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CuponController;

use App\Http\Controllers\PrecioController;


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

Route::get('/',[HomeController::class,'index'])->name('index');
Route::get('/terminos-y-condiciones',[HomeController::class,'terminos']);
Route::get('/avisos-de-privacidad',[HomeController::class,'privacidad']);

Route::post('/webhooks',WebhoocksController::class);

Auth::routes();

Route::get('/pagar/transferencia/subir/{id}',[PaymentController::class,'vista_subir']);
Route::post('/pagar/transferencia/subir/{id}',[PaymentController::class,'upload_transferencia']);

//BUSQUEDA SENCILLA
Route::get('/buscar',[CorridaController::class,'buscar'])->name('corrida.buscar');
Route::post('/buscar',[PasajeroController::class,'mostrar_pasajeros']);
    
Route::get('/reservar/{id}',[PasajeroController::class,'mostrar_ingreso_pasajeros'])->name('mostrar_ingreso_pasajeros');
Route::post('/reservar/{id}',[PasajeroController::class,'validate_pasajeros'])->name('reservar_asientos');
    
Route::get('/reservar/{id}/asiento',[CorridaController::class,'mostrar_asientos'])->name('mostrar_asientos');
Route::post('/reservar/{id}/asiento',[CorridaController::class,'validate_asiento'])->name('validate_asiento');
    
Route::get('/pagar/{id}',[CorridaController::class,'vista_pagar'])->name('vista_pagar');
Route::post('/descuento/cupon/{id}',[PaymentController::class,'descontar'])->name('descuento_cupon');
Route::post('/pagar/transferencia/{id}',[PaymentController::class,'pagar_transferencia'])->name('pagar_transferencia');
Route::get('/reserva/success/{id}',[CorridaController::class,'informacion_viaje'])->name('reserva_informacion');

//BUSQUEDA REDONDA
Route::get('/buscar/vuelta',[CorridaController::class,'buscar_redondo'])->name('corrida.buscar.redondo');
Route::post('/buscar/vuelta',[PasajeroController::class,'reserva_pasajeros_vuelta'])->name('corrida.buscar.redondo');

Route::get('/reservar/redondo/{id}',[PasajeroController::class,'mostrar_ingreso_pasajeros_redondo'])->name('mostrar_ingreso_pasajeros_redondo');
Route::post('/reservar/redondo/{id}',[PasajeroController::class,'validate_pasajeros_redondo'])->name('validate_pasajeros_redondo');

Route::get('/reservar/ida/{id}/asiento',[CorridaController::class,'mostrar_asientos_ida'])->name('mostrar_asientos_ida');
Route::post('/reservar/ida/{id}/asiento',[CorridaController::class,'mostrar_asientos_ida_validate']);
Route::get('/reservar/vuelta/{id}/asiento',[CorridaController::class,'mostrar_asientos_vuelta'])->name('mostrar_asientos_vuelta');
Route::post('/reservar/vuelta/{id}/asiento',[CorridaController::class,'mostrar_asientos_vuelta_validate']);

Route::get('/pagar/redondo/{id}',[CorridaController::class,'vista_pagar_redondo'])->name('vista_pagar_redondo');
Route::get('/payment/redondo/success/{id}/payment',[PaymentController::class,'vista_success_redondo'])->name('payment.success.redondo');
Route::get('/reserva/redondo/success/{ida}/{vuelta}',[CorridaController::class,'informacion_viaje_redondo'])->name('reserva_informacion_redondo');



//MERCADO PAGO
Route::get('/payment/success/{id}/payment',[PaymentController::class,'vista_success'])->name('payment.success');
Route::get('/payment/fail',[PaymentController::class,'vista_fail'])->name('payment.fail');
Route::get('/payment/pending',[PaymentController::class,'vista_pending'])->name('payment.pending');

//TRANSFERENCIA
Route::get('/reserva/transferencia/{id}',[CorridaController::class,'informacion_transferencia'])->name('reserva_transferencia');

Route::middleware(['auth'])->group(function(){
    // VER RESERVAS
    Route::get('/reservas/ver/{id}',[UserController::class,'ver_reservas'])->name('ver_reservas');
    Route::get('/pago/{id}',[PaymentController::class,'show'])->name('ver_corrida');

    // PASAJE ADMIN
    Route::get('/buscar/admin',[HomeController::class,'buscador'])->name('corrida.admin_buscar')->middleware('admin');

    Route::resource('unidad',UnidadController::class)->middleware('admin');
    Route::resource('chofer',ChoferController::class)->middleware('admin');
    Route::resource('corrida',CorridaController::class)->middleware('admin');
    Route::resource('servicio',ServicioController::class)->middleware('admin');
    Route::resource('destino',DestinoController::class)->middleware('admin');
    Route::resource('cupon',CuponController::class)->middleware('admin');

    //VER PASAJEROS
    Route::get('pasajeros',[PasajeroController::class,'verCorridas'])->name('pasajeros.verCorridas')->middleware('conductor');
    Route::get('pasajeros/{id}',[PasajeroController::class,'show'])->name('pasajeros.ver')->middleware('conductor');
    Route::get('pasajeros/{id}/descargar',[PasajeroController::class,'download_pasajeros'])->name('pasajeros.descargar')->middleware('conductor');
    
    //TRANSFERENCIAS
    Route::get('transferencias',[PaymentsImageController::class,'index'])->name('ver_transferencias')->middleware('admin');
    Route::get('transferencia/{id}',[PaymentsImageController::class,'show'])->name('ver_transferencia')->middleware('admin');
    Route::post('transferencia/{id}',[PaymentsImageController::class,'edit'])->middleware('admin');

    //PAGOS
    Route::get('/buscar/pagos',[PaymentController::class,'view_look'])->name('pagos.buscador')->middleware('admin');
    Route::get('/buscar/pagos/busqueda',[PaymentController::class,'see_pagos'])->name('pagos.coincidencias')->middleware('admin');
});