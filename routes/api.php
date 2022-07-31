<?php

use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {

    //Users
    Route::prefix('user')->group(function (){
        Route::get('/', [UserController::class, 'index']);
        Route::post('/create', [UserController::class, 'store']);
    });

    //Shifts
    Route::prefix('shift')->group(function (){
        Route::get('/', [ShiftController::class, 'index']);
        Route::get('/start/{id}', [ShiftController::class, 'start']);
        Route::get('/end/{id}', [ShiftController::class, 'end']);
        Route::get('/end-and-go-to-next/{id}/{next_id}', [ShiftController::class, 'goToNext']);
    });

});


