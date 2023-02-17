<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SessionController;
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
    Route::prefix('users')->group(function (){
        Route::get('/', [UserController::class, 'index']);
        Route::get('/violinists', [UserController::class, 'violinists']);
        Route::get('/keyboardists', [UserController::class, 'keyboardists']);
        Route::get('/worship-leaders', [UserController::class, 'worshipLeaders']);
        Route::post('/update/{id}', [UserController::class, 'update']);
        Route::post('/delete', [UserController::class, 'destroy']);
        Route::post('/profile', [UserController::class, 'updateProfile']);
        Route::post('/create', [UserController::class, 'store']);
        Route::get('/check-in/{id}', [AttendanceController::class, 'checkIn']);
        Route::get('/check-out/{id}', [AttendanceController::class, 'checkOut']);
    });

    Route::prefix('sessions')->group(function(){
        Route::get('/', [SessionController::class, 'sessionsKeyboardists']);
    });

    //Shifts
    Route::prefix('shift')->group(function (){
        Route::get('/', [ShiftController::class, 'index']);
        Route::get('/sessions/{id}', [ShiftController::class, 'show']);
        Route::get('/start/{id}/{type?}', [ShiftController::class, 'start']);
        Route::get('/end/{id}/{type?}', [ShiftController::class, 'end']);
        Route::get('/end-and-go-to-next/{id}/{next_id}/{type?}', [ShiftController::class, 'goToNext']);
    });

    Route::prefix('report')->group(function (){
        Route::get('/', [ShiftController::class, 'generateReport']);
    });

});
