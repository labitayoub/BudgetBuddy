<?php
use App\Http\Controllers\ExpenseController;
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
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //     return $request->user();
    
    Route::post('/auth/register', [AuthController::class, 'createUser']);
    Route::post('/auth/login', [AuthController::class, 'loginUser']);
    
    Route::post('auth/logout', [AuthController::class, 'logoutUser']);
    
    // Route::middleware('auth:sanctum')->group(function () {
        //     Route::get('/user', function (Request $request) {
            //         return $request->user();
            //     });
            // });
            
            // Route::resource('expenses', ExpenseController::class);
            
            Route::get('/expenses/search/{name}', [ExpenseController::class, 'search']);
            Route::get('/expenses', [ExpenseController::class, 'index']);
            Route::get('/expenses{id}', [ExpenseController::class, 'show']);
            
            
            Route::group(['middleware' => ['auth:sanctum']], function () {
                Route::post('/expenses', [ExpenseController::class, 'store']);
                Route::put('/expenses/{id}', [ExpenseController::class, 'update']);
                Route::delete('/expenses', [ExpenseController::class, 'destroy']);
                //     Route::post('/logout', [AuthController::class, 'logout']);
                });
                

