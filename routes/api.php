<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\NotesController;
use App\Http\Controllers\API\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth.api')->group(function () {

    Route::get('/notes', [NotesController::class, 'index']);
    Route::post('/notes', [NotesController::class, 'store']);

    Route::get('/users', [UsersController::class, 'index']);

});
