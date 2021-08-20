<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\ChoferController;
use App\Http\Controllers\CorridaController;
use App\Http\Controllers\PasajeroController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WebhoocksController;


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
    return view('welcome');
})->middleware('auth')->name('index');

Auth::routes();

Route::get('/nosotros',function(){
    return view('nosotros');
});


Route::middleware(['auth'])->group(function(){
    Route::get('/buscar',[CorridaController::class,'buscar'])->name('corrida.buscar');
    Route::post('/buscar',[PasajeroController::class,'mostrar_pasajeros']);
    
    Route::get('/reservar/{id}',[PasajeroController::class,'mostrar_ingreso_pasajeros'])->name('mostrar_ingreso_pasajeros');
    Route::post('/reservar/{id}',[PasajeroController::class,'validate_pasajeros'])->name('reservar_asientos');
    
    Route::get('/reservar/{id}/asiento',[CorridaController::class,'mostrar_asientos'])->name('mostrar_asientos');
    Route::post('/reservar/{id}/asiento',[CorridaController::class,'validate_asiento'])->name('validate_asiento');
    
    Route::get('/pagar/{id}',[CorridaController::class,'vista_pagar'])->name('vista_pagar');
    Route::post('/descuento/cupon/{id}',[PaymentController::class,'descontar'])->name('descuento_cupon');

    Route::get('/payment/success/{id}/payment',[PaymentController::class,'vista_success'])->name('payment.success');
    Route::get('/payment/fail',[PaymentController::class,'vista_fail'])->name('payment.fail');
    Route::get('/payment/pending',[PaymentController::class,'vista_pending'])->name('payment.pending');

    Route::get('/reserva/success/{id}',[CorridaController::class,'informacion_viaje'])->name('reserva_informacion');

    Route::post('/webhooks',WebhoocksController::class);

    Route::resource('unidad',UnidadController::class);
    Route::resource('chofer',ChoferController::class);
    Route::resource('corrida',CorridaController::class);
    Route::resource('servicio',ServicioController::class);
    Route::get('pasajeros',[PasajeroController::class,'verCorridas'])->name('pasajeros.verCorridas');
    Route::get('pasajeros/{id}',[PasajeroController::class,'show'])->name('pasajeros.ver');
});