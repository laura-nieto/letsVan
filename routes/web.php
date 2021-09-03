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

Route::get('/',[HomeController::class,'index'])->middleware('auth')->name('index');

Route::post('/webhooks',WebhoocksController::class);

Auth::routes();

Route::get('/pagar/transferencia/subir/{id}',[PaymentController::class,'vista_subir']);
Route::post('/pagar/transferencia/subir/{id}',[PaymentController::class,'upload_transferencia']);

Route::middleware(['auth'])->group(function(){
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

    //MERCADO PAGO
    Route::get('/payment/success/{id}/payment',[PaymentController::class,'vista_success'])->name('payment.success');
    Route::get('/payment/fail',[PaymentController::class,'vista_fail'])->name('payment.fail');
    Route::get('/payment/pending',[PaymentController::class,'vista_pending'])->name('payment.pending');

    //TRANSFERENCIA
    Route::get('/reserva/transferencia/{id}',[CorridaController::class,'informacion_transferencia'])->name('reserva_transferencia');

    // PASAJE ADMIN
    Route::get('/buscar/admin',[HomeController::class,'buscador'])->name('corrida.admin_buscar');

    Route::resource('unidad',UnidadController::class);
    Route::resource('chofer',ChoferController::class);
    Route::resource('corrida',CorridaController::class);
    Route::resource('servicio',ServicioController::class);
    Route::resource('destino',DestinoController::class);
    Route::get('pasajeros',[PasajeroController::class,'verCorridas'])->name('pasajeros.verCorridas');
    Route::get('pasajeros/{id}',[PasajeroController::class,'show'])->name('pasajeros.ver');
    
    //TRANSFERENCIAS
    Route::get('transferencias',[PaymentsImageController::class,'index'])->name('ver_transferencias');
    Route::get('transferencia/{id}',[PaymentsImageController::class,'show'])->name('ver_transferencia');
    Route::post('transferencia/{id}',[PaymentsImageController::class,'edit']);
});