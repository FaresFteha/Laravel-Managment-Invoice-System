<?php

use App\Http\Controllers\Client\InvoiceController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/client')->middleware('auth:client')->group(function () {

    Route::get('/home', function () {

        return view('page.backend.Clients_Cpanel.index');
    })->name('home.client');

    Route::get('products-client', [ProductController::class, 'index'])->name('products.client.index');

    Route::get('incoices', [InvoiceController::class, 'index'])->name('incoices.client.index');
    Route::get('incoices-show/{id}', [InvoiceController::class, 'show'])->name('incoices.client.show');
    Route::get('printFatora/{id}', [InvoiceController::class, 'printFatora'])->name('incoices.client.printFatora');
    Route::get('payments-Fatora/{id}', [InvoiceController::class, 'payments'])->name('incoices.client.payment');
    
    Route::get('profile-Client', [ProfileController::class, 'index'])->name('incoices.client.profile');
    Route::post('profile-update', [ProfileController::class, 'update'])->name('incoices.client.update');
});
