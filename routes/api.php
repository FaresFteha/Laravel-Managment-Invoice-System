<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\TaxController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::middleware('jwt.verify')->group(function () {

// });



Route::prefix('user')->group(function () {
    // authenticated staff routes here 
    Route::post('login/{type}', [AuthController::class, 'login']);
    Route::get('logout/{type}', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);
});

Route::prefix('dashboard')->group(function () {
    //API category
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/{id}', [CategoryController::class, 'show']);
    Route::post('/category-store', [CategoryController::class, 'store']);
    Route::post('/category-update/{id}', [CategoryController::class, 'update']);
    Route::post('/category-destory/{id}', [CategoryController::class, 'destory']);

    //API client
    Route::get('/client', [ClientController::class, 'index']);
    Route::get('/client/{id}', [ClientController::class, 'show']);
    Route::post('/client-store', [ClientController::class, 'store']);
    Route::post('/client-update/{id}', [ClientController::class, 'update']);
    Route::post('/client-destory/{id}', [ClientController::class, 'destory']);

    //API Tax
    Route::get('/tax', [TaxController::class, 'index']);
    Route::get('/tax/{id}', [TaxController::class, 'show']);
    Route::post('/tax-store', [TaxController::class, 'store']);
    Route::post('/tax-update/{id}', [TaxController::class, 'update']);
    Route::post('/tax-destory/{id}', [TaxController::class, 'destory']);

    //API Product
    Route::get('/product', [ProductController::class, 'index']);
    Route::get('/product/{id}', [ProductController::class, 'show']);
    Route::post('/product-store', [ProductController::class, 'store']);
    Route::post('/product-update/{id}', [ProductController::class, 'update']);
    Route::post('/product-destory/{id}', [ProductController::class, 'destory']);
});
