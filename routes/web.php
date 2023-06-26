<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceStatusController;
use App\Http\Controllers\InvoiceArchiveController;
use App\Http\Controllers\InvoiceAttachmentsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('auth');

Route::prefix('dasboared')->middleware('auth')->group(function () {
    // Client route
    Route::get('states-list', [ClientController::class, 'getStates'])->name('states-list');
    Route::get('cities-list', [ClientController::class, 'getCities'])->name('cities-list');
    Route::resource('clients', ClientController::class);

    //Category Route
    Route::resource('categories', CategoryController::class)->except([
        'create',
        'show',
        'edit'
    ]);

    //Tax Route
    Route::resource('taxes', TaxController::class)->except([
        'create',
        'show',
        'edit'
    ]);

    //Product Route
    Route::resource('products', ProductController::class);


    Route::get('products-list', [InvoiceController::class, 'getProduct'])->name('products-list');
    //Invoice Route
    Route::post('Insert-Attachments', [InvoiceController::class, 'insertAttachments'])->name('Attachments');
    //Status Change
    Route::get('status-change/{id}', [InvoiceController::class, 'getStatus'])->name('status-change');
    Route::post('status-change-post', [InvoiceController::class, 'chngeStatus'])->name('status-change-post');
    Route::resource('invoices', InvoiceController::class);
    Route::get('Insert-Attachments-donlowad/{filename}', [InvoiceAttachmentsController::class, 'donlowad'])->name('Insert-Attachments-donlowad');
    Route::resource('invoicesAttachments', InvoiceAttachmentsController::class)->except([
        'create',
        'show',
        'edit',
        'update'
    ]);

    Route::get('exportstatysinvoices', [InvoiceStatusController::class, 'exportstatysinvoices'])->name('Incoices-status-export');
    Route::resource('invoicesstatus', InvoiceStatusController::class)->except([
        'update'
    ]);

    Route::resource('invoicesArchive', InvoiceArchiveController::class)->except([
        'store',
        'create',
        'show',
        'edit',
    ]);

    Route::get('invoicePrint/{id}', [InvoiceController::class, 'invoicePrint'])->name('invoicePrint');
    Route::get('Incoices-Print-All', [InvoiceController::class, 'invoiceAll'])->name('Incoices-Print-All');

    Route::resource('payment', PaymentController::class);
    Route::get('Incoices-Payment', [PaymentController::class, 'incoicesPaymentExport'])->name('Incoices-Payment');
    Route::get('payment_print/{id}', [PaymentController::class, 'payment_print'])->name('payment_print');


    Route::get('/setting', [SettingController::class, 'index'])->name('setting-home');
    Route::post('/update-setting', [SettingController::class, 'updateSetting'])->name('update-setting');
    Route::get('/clear-cache', [SettingController::class, 'clearCache'])->name('clear-cache');


    //Notify 
    Route::get('readAllNotify', [InvoiceController::class, 'readAllNotify'])->name('readAllNotify');
    Route::get('/notifications', [InvoiceController::class, 'notifications'])->name('notifications-home');

    Route::prefix('admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
    });
});
