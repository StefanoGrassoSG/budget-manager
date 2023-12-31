<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CsrfTokenController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\api\AdminController;
use App\Http\Controllers\api\TransactionController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});






Route::group(['middleware' => ['api']], function () {
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/user', [AuthController::class, 'me']);
    Route::post('/check', [AuthController::class, 'check']);
    Route::get('/stats', [AdminController::class, 'budget']);
    Route::post('/old', [AdminController::class, 'oldBudget']);
    Route::get('/index', [TransactionController::class, 'index']);
    Route::post('/indexOld', [TransactionController::class, 'indexOld']);
    Route::post('/store', [TransactionController::class, 'store']);
    Route::post('/destroy/{transaction}', [TransactionController::class, 'destroy']);
    Route::post('/show/{transaction}', [TransactionController::class, 'show']);
});



