<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatonController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;

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

Route::post('/register', [AuthenticatonController::class, 'register']);
Route::post('/login', [AuthenticatonController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Route::get('/get-users', [UserController::class, 'getUsers']);
    Route::post('/add-user', [UserController::class, 'addUser']);
    Route::put('/edit-user/{id}', [UserController::class, 'editUser']);
    Route::delte('/delete-user/{id}', [UserController::class, 'deleteUser']);

    Route::post('/logout', [AuthenticationController::class, 'logout']);
});
