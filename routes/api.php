<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

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

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::get('/auth/user/{id}', [AuthController::class, 'getUser']);


// Route::resource('expenses', ExpenseController::class);

Route::get('/expenses/search/{name}', [ExpenseController::class, 'search']);
Route::get('/expenses', [ExpenseController::class, 'index']);
Route::get('/expenses/{id}', [ExpenseController::class, 'show']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/expenses', [ExpenseController::class, 'store']);
    Route::put('/expenses/{id}', [ExpenseController::class, 'update']);
    Route::delete('/expenses', [ExpenseController::class, 'destroy']);
    Route::post('/auth/logout', [AuthController::class, 'logoutUser']);
    Route::get('/tags', [TagController::class, 'index']);
    Route::post('/tags', [TagController::class, 'store']);
    Route::put('/tags/{id}', [TagController::class, 'update']);
    Route::delete('/tags/{id}', [TagController::class, 'destroy']);
    Route::get('/tags/{id}', [TagController::class, 'show']);
    
});
