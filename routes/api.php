<?php

use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Http\Controllers\Admin\Task\TaskController as AdminTaskController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\TuitorialController;
use App\Http\Controllers\Writer\Task\TaskController as WriterTaskController;
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

/*Authentication Routes*/
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/logout', [LoginController::class, 'logout']);


Route::middleware('auth:sanctum')->group(function () {


    /*Admin Task Routes*/
    Route::group(['prefix' => 'admin/task', []], function () {
        Route::get('/index', [AdminTaskController::class, 'index']);
        Route::post('/store', [AdminTaskController::class, 'store']);
        Route::get('/delete/{id}', [AdminTaskController::class, 'destroy']);
        Route::get('/active', [AdminTaskController::class, 'activeTasks']);
        Route::get('/submitted', [AdminTaskController::class, 'submitted']);
        Route::get('/completed', [AdminTaskController::class, 'completed']);
        Route::get('/inRevision', [AdminTaskController::class, 'inRevision']);
        Route::get('/cancelled', [AdminTaskController::class, 'cancelled']);
        Route::post('/taskAction/{action}/{task_id}', [AdminTaskController::class, 'taskAction']);
    });
    /*Writer Task Routes*/
    Route::group(['prefix' => 'writer/task', []], function () {
        Route::get('/index', [WriterTaskController::class, 'index']);
        Route::get('/active', [WriterTaskController::class, 'activeTasks']);
        Route::get('/waiting-for-rating', [WriterTaskController::class, 'waitingforRatingTasks']);
        Route::get('/completed', [WriterTaskController::class, 'completedTasks']);
        Route::get('/cancelled', [WriterTaskController::class, 'cancelledTasks']);
        Route::get('/pick/task/{task_id}', [WriterTaskController::class, 'pickTask']);
        Route::get('/download/taskMaterials/{task_id}', [WriterTaskController::class, 'downloadTaskMaterials']);
        Route::get('/revoke/cancellation/ability/{task_id}', [WriterTaskController::class, 'revokeCancellationAbility']);
        Route::post('/submit/{task_id}', [WriterTaskController::class, 'update']);
        Route::get('/delete/{id}', [WriterTaskController::class, 'destroy']);
    });

    /*Admin Tuitorial Routes*/
    Route::group(['prefix' => 'admin/tuitorial', []], function () {
        Route::get('/index', [TuitorialController::class, 'index']);
        Route::post('/store', [TuitorialController::class, 'store']);
        Route::get('/delete/{id}', [TuitorialController::class, 'destroy']);
    });

    /*Admin Settings Routes*/
    Route::group(['prefix' => 'admin/settings', []], function () {
        Route::get('/activeWriters', [SettingsController::class, 'activeWriters']);
        Route::get('/blockedWriters', [SettingsController::class, 'blockedWriters']);
        Route::get('/applicantWriters', [SettingsController::class, 'applicantWriters']);
        Route::get('/allAdmins', [SettingsController::class, 'allAdmins']);
        Route::get('/userAction/{action}/{user_id}', [SettingsController::class, 'userAction']);
    });

    /*Ratings Routes*/
    Route::group(['prefix' => 'ratings', []], function () {

        Route::get('/index', [RatingController::class, 'index']);
        Route::get('/writerRating/{writer_id}', [RatingController::class, 'writerRating']);
        Route::post('/store', [RatingController::class, 'store']);
    });

});


