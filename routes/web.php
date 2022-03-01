<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/',[App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/producto/imagen/{filename?}', [App\Http\Controllers\ProductoController::class, 'getImagen'])->name('producto.imagen');
Route::get('/producto/{id}',[App\Http\Controllers\ProductoController::class, 'getProducto'])->name('producto.detalles');
Route::post('/comentario/save', [App\Http\Controllers\ComentarioController::class, 'save'])->name('comentarios.save');
Route::post('/pedido/carrito/agregar',[App\Http\Controllers\PedidoController::class, 'agregarCarrito'])->name('pedido.agregarCarrito');
Route::get('/carrito',[App\Http\Controllers\PedidoController::class, 'getCarrito'])->name('pedido.carrito');
Route::get('/pedido/hacerpedido',[App\Http\Controllers\PedidoController::class, 'toPayment'])->name('pedido.toPayment');
Route::post('/pedido/pagar',[App\Http\Controllers\PedidoController::class, 'pay'])->name('pedido.pay');
Route::get('/pedido/success',[App\Http\Controllers\PedidoController::class, 'paymentsuccess'])->name('pedido.paymentsuccess');