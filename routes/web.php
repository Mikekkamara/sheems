<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    return redirect('/login');
});

Auth::routes([ 'register' =>  false ]);

// Route::get('/insert-users',[UserController::class, 'create']);
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/home',[HomeController::class, 'index']);
    Route::get('/users', [HomeController::class, 'index']);
});
