<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'App\Http\Controllers\UserController@login');
Route::post('loginWithGoogle', 'App\Http\Controllers\UserController@loginWithGoogle');
Route::post('authenticate', 'App\Http\Controllers\UserController@authenticate');
Route::post('recover', 'App\Http\Controllers\UserController@recover');
Route::post('reset', 'App\Http\Controllers\UserController@reset');

Route::group(['middleware' => ['jwt.verify']], function()
{
    Route::post('admin/dashboard', 'App\Http\Controllers\HomeController@admin');
    
    // Rutas para sesión
    Route::post('me', 'App\Http\Controllers\UserController@me');
    Route::post('refresh', 'App\Http\Controllers\UserController@refresh');
    Route::post('logout', 'App\Http\Controllers\UserController@logout');
    Route::post('report/resources', 'App\Http\Controllers\ReportController@resources');

    // Rutas  para roles
    Route::post('role/list', 'App\Http\Controllers\RoleController@list')->middleware('can:role.list');
    Route::get('role/{role}', 'App\Http\Controllers\RoleController@show')->middleware('can:role.list');
    Route::post('role', 'App\Http\Controllers\RoleController@store')->middleware('can:role.store');
    Route::put('role/{role}', 'App\Http\Controllers\RoleController@update')->middleware('can:role.update');
    Route::delete('role/{role}', 'App\Http\Controllers\RoleController@destroy')->middleware('can:role.destroy');

    // Rutas para personas
    Route::get('person/{document}', 'App\Http\Controllers\PersonController@search');

    // Rutas para usuarios
    Route::post('user/list', 'App\Http\Controllers\UserController@list')->middleware('can:user.list');
    Route::get('user/{user}', 'App\Http\Controllers\UserController@show')->middleware('can:user.list');
    Route::get('user/search/{document}', 'App\Http\Controllers\UserController@search');
    Route::post('user/find', 'App\Http\Controllers\UserController@find');
    Route::post('user/repassword', 'App\Http\Controllers\UserController@repassword');
    Route::post('user', 'App\Http\Controllers\UserController@store')->middleware('can:user.store');
    Route::put('user/{user}', 'App\Http\Controllers\UserController@update')->middleware('can:user.update');
    Route::delete('user/{user}', 'App\Http\Controllers\UserController@destroy')->middleware('can:user.destroy');
    Route::post('user/resources', 'App\Http\Controllers\UserController@resources');

    //Rutas para Sedes
    Route::post( 'headquarter/list', 'App\Http\Controllers\HeadquarterController@list' )->middleware( 'can:headquarter.list' );
    Route::get( 'headquarter/{headquarter}', 'App\Http\Controllers\HeadquarterController@show' )->middleware( 'can:headquarter.list' );
    Route::post( 'headquarter', 'App\Http\Controllers\HeadquarterController@store' )->middleware( 'can:headquarter.store' );
    Route::put( 'headquarter/{headquarter}', 'App\Http\Controllers\HeadquarterController@update' )->middleware( 'can:headquarter.update' );
    Route::delete( 'headquarter/{headquarter}', 'App\Http\Controllers\HeadquarterController@destroy' )->middleware( 'can:headquarter.destroy' );
});
