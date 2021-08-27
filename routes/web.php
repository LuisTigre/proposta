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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('propostas',App\Http\Controllers\PropostasController::class);
Route::get('/export/propostas',[App\Http\Controllers\PropostasController::class, 'export'])->name('propostas.export');


Route::resource('clientes',App\Http\Controllers\ClientesController::class);