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
    return view('layouts/app');
});

// ======================= RUTAS PARA TESTEO =======================
// Route::post('headquarter', 'App\Http\Controllers\HeadquarterController@store');
// Route::post('investigation', 'App\Http\Controllers\InvestigationController@store');
// Route::put('investigation/{investigation}', 'App\Http\Controllers\InvestigationController@update');


Route::get('/{any?}', function () {
    return view('layouts/app');
})->name('welcome')->where('any','.*');