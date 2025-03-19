<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\GroupController;
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

/**
 * @OA\Get(
 *     path="/api/produits",
 *     @OA\Response(response="200", description="Liste des produits")
 * )
 */

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::get('/auth/user/{id}', [AuthController::class, 'getUser']);


// Route::resource('expenses', ExpenseController::class);
// Route::get('/expenses/search/{name}', [ExpenseController::class, 'search']);



Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/expenses', [ExpenseController::class, 'index']);
    Route::get('/expenses/{id}', [ExpenseController::class, 'show']);
    Route::post('/expenses', [ExpenseController::class, 'store']);
    Route::put('/expenses/{id}', [ExpenseController::class, 'update']);                                        
    Route::delete('/expenses', [ExpenseController::class, 'destroy']);

    Route::post('/auth/logout', [AuthController::class, 'logoutUser']);

    Route::get('/tags', [TagController::class, 'index']);
    Route::post('/tags', [TagController::class, 'store']);
    Route::put('/tags/{id}', [TagController::class, 'update']);
    Route::delete('/tags/{id}', [TagController::class, 'destroy']);
    Route::get('/tags/{id}', [TagController::class, 'show']);

    Route::post('/expenses/{id}/tags', [ExpenseController::class, 'addTags']);

    Route::get('/groups', [GroupController::class, 'index']);
    Route::get('/groups/{id}', [GroupController::class, 'show']);
    Route::post('/groups', [GroupController::class, 'store']);
    Route::put('/groups/{id}', [GroupController::class, 'update']);                                        
    Route::delete('/groups/{id}', [GroupController::class, 'destroy']);
    
});
