<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DiverController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\StationOrTownController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('station-or-towns', StationOrTownController::class);
        Route::resource('vehicles', VehicleController::class);
        Route::resource('divers', DiverController::class);
        Route::resource('routes', RouteController::class);
        Route::resource('tickets', TicketController::class);
        Route::resource('users', UserController::class);
    });
