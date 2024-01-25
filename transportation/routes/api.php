<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\DiverController;
use App\Http\Controllers\Api\RouteController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\VehicleController;
use App\Http\Controllers\Api\UserRoutesController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\UserTicketsController;
use App\Http\Controllers\Api\RouteTicketsController;
use App\Http\Controllers\Api\StationOrTownController;
use App\Http\Controllers\Api\VehicleRoutesController;
use App\Http\Controllers\Api\DiverVehiclesController;
use App\Http\Controllers\Api\StationOrTownUsersController;
use App\Http\Controllers\Api\StationOrTownRoutesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('station-or-towns', StationOrTownController::class);

        // StationOrTown Users
        Route::get('/station-or-towns/{stationOrTown}/users', [
            StationOrTownUsersController::class,
            'index',
        ])->name('station-or-towns.users.index');
        Route::post('/station-or-towns/{stationOrTown}/users', [
            StationOrTownUsersController::class,
            'store',
        ])->name('station-or-towns.users.store');

        // StationOrTown Routes
        Route::get('/station-or-towns/{stationOrTown}/routes', [
            StationOrTownRoutesController::class,
            'index',
        ])->name('station-or-towns.routes.index');
        Route::post('/station-or-towns/{stationOrTown}/routes', [
            StationOrTownRoutesController::class,
            'store',
        ])->name('station-or-towns.routes.store');

        // StationOrTown Routes2
        Route::get('/station-or-towns/{stationOrTown}/routes', [
            StationOrTownRoutesController::class,
            'index',
        ])->name('station-or-towns.routes.index');
        Route::post('/station-or-towns/{stationOrTown}/routes', [
            StationOrTownRoutesController::class,
            'store',
        ])->name('station-or-towns.routes.store');

        Route::apiResource('vehicles', VehicleController::class);

        // Vehicle Routes
        Route::get('/vehicles/{vehicle}/routes', [
            VehicleRoutesController::class,
            'index',
        ])->name('vehicles.routes.index');
        Route::post('/vehicles/{vehicle}/routes', [
            VehicleRoutesController::class,
            'store',
        ])->name('vehicles.routes.store');

        Route::apiResource('divers', DiverController::class);

        // Diver Vehicles
        Route::get('/divers/{diver}/vehicles', [
            DiverVehiclesController::class,
            'index',
        ])->name('divers.vehicles.index');
        Route::post('/divers/{diver}/vehicles', [
            DiverVehiclesController::class,
            'store',
        ])->name('divers.vehicles.store');

        Route::apiResource('routes', RouteController::class);

        // Route Tickets
        Route::get('/routes/{route}/tickets', [
            RouteTicketsController::class,
            'index',
        ])->name('routes.tickets.index');
        Route::post('/routes/{route}/tickets', [
            RouteTicketsController::class,
            'store',
        ])->name('routes.tickets.store');

        Route::apiResource('tickets', TicketController::class);

        Route::apiResource('users', UserController::class);

        // User Tickets
        Route::get('/users/{user}/tickets', [
            UserTicketsController::class,
            'index',
        ])->name('users.tickets.index');
        Route::post('/users/{user}/tickets', [
            UserTicketsController::class,
            'store',
        ])->name('users.tickets.store');

        // User Routes
        Route::get('/users/{user}/routes', [
            UserRoutesController::class,
            'index',
        ])->name('users.routes.index');
        Route::post('/users/{user}/routes', [
            UserRoutesController::class,
            'store',
        ])->name('users.routes.store');
    });
