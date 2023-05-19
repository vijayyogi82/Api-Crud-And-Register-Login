<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EmployeeController;
use App\Models\Employee;

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

Route::controller(AuthController::class)->group(function () {

    Route::post('register', 'register');
    Route::post('login', 'login');

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('logout', 'logout');
        Route::post('user', 'user');
    });
});

Route::get('employee/read', [EmployeeController::class, 'read']);
Route::post('employee/store', [EmployeeController::class, 'store']);
Route::post('employee/delete/{id}', [EmployeeController::class, 'delete']);
Route::post('employee/edit/{id}', [EmployeeController::class, 'edit']);
