<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IpaBajaController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemEntryController;
use App\Http\Controllers\ItemExitController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectReportController;
use App\Http\Controllers\StockReportController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// Storage Link
Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage linked successfully';
});

// Routes untuk semua role
Route::middleware(['checkLogin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'indexLogin']);
    Route::post('/login', [AuthController::class, 'login']);
});

// Routes untuk superadmin
Route::middleware(['checkLogin', 'role:superadmin'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/create', [CategoryController::class, 'create']);
    Route::post('/categories/store', [CategoryController::class, 'store']);
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/delete/{id}', [CategoryController::class, 'delete']);

    Route::get('/units', [UnitController::class, 'index']);
    Route::get('/units/create', [UnitController::class, 'create']);
    Route::post('/units/store', [UnitController::class, 'store']);
    Route::get('/units/edit/{id}', [UnitController::class, 'edit']);
    Route::put('/units/{id}', [UnitController::class, 'update']);
    Route::delete('/units/delete/{id}', [UnitController::class, 'delete']);

    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/create', [ProductController::class, 'create']);
    Route::post('/products/store', [ProductController::class, 'store']);
    Route::get('/products/edit/{id}', [ProductController::class, 'edit']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/delete/{id}', [ProductController::class, 'delete']);

    Route::get('/vendors', [VendorController::class, 'index']);
    Route::get('/vendors/create', [VendorController::class, 'create']);
    Route::post('/vendors/store', [VendorController::class, 'store']);
    Route::get('/vendors/edit/{id}', [VendorController::class, 'edit']);
    Route::put('/vendors/{id}', [VendorController::class, 'update']);
    Route::delete('/vendors/delete/{id}', [VendorController::class, 'delete']);

    Route::get('/clients', [ClientController::class, 'index']);
    Route::get('/clients/create', [ClientController::class, 'create']);
    Route::post('/clients/store', [ClientController::class, 'store']);
    Route::get('/clients/edit/{id}', [ClientController::class, 'edit']);
    Route::put('/clients/{id}', [ClientController::class, 'update']);
    Route::delete('/clients/delete/{id}', [ClientController::class, 'delete']);

    Route::get('/ipabajas', [IpaBajaController::class, 'index']);
    Route::get('/ipabajas/create', [IpaBajaController::class, 'create']);
    Route::post('/ipabajas/store', [IpaBajaController::class, 'store']);
    Route::get('/ipabajas/edit/{id}', [IpaBajaController::class, 'edit']);
    Route::put('/ipabajas/{id}', [IpaBajaController::class, 'update']);
    Route::delete('/ipabajas/delete/{id}', [IpaBajaController::class, 'delete']);
});

Route::middleware(['checkLogin', 'role:admin,owner,superadmin'])->group(function () {
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/create', [ProjectController::class, 'create']);
    Route::post('/projects/store', [ProjectController::class, 'store']);
    Route::get('/projects/edit/{id}', [ProjectController::class, 'edit']);
    Route::put('/projects/{id}', [ProjectController::class, 'update']);
    Route::delete('/projects/delete/{id}', [ProjectController::class, 'delete']);

    Route::get('/items', [ItemController::class, 'index']);
    Route::get('/items/create', [ItemController::class, 'create']);
    Route::post('/items/store', [ItemController::class, 'store']);
    Route::get('/items/edit/{id}', [ItemController::class, 'edit']);
    Route::put('/items/{id}', [ItemController::class, 'update']);
    Route::delete('/items/delete/{id}', [ItemController::class, 'delete']);

    Route::get('/item-entries', [ItemEntryController::class, 'index']);
    Route::get('/item-entries/create', [ItemEntryController::class, 'create']);
    Route::post('/item-entries/store', [ItemEntryController::class, 'store']);
    Route::get('/item-entries/edit/{id}', [ItemEntryController::class, 'edit']);
    Route::put('/item-entries/{id}', [ItemEntryController::class, 'update']);
    Route::delete('/item-entries/delete/{id}', [ItemEntryController::class, 'delete']);

    Route::get('/item-exits', [ItemExitController::class, 'index']);
    Route::get('/item-exits/create', [ItemExitController::class, 'create']);
    Route::post('/item-exits/store', [ItemExitController::class, 'store']);
    Route::get('/item-exits/edit/{id}', [ItemExitController::class, 'edit']);
    Route::put('/item-exits/{id}', [ItemExitController::class, 'update']);
    Route::delete('/item-exits/delete/{id}', [ItemExitController::class, 'delete']);

    Route::get('/stock-reports', [StockReportController::class, 'index']);
    Route::get('/stock-reports/export', [StockReportController::class, 'exportPDF']);

    Route::get('/stock-transactions', [StockTransactionController::class, 'index']);
    Route::get('/stock-transactions/export', [StockTransactionController::class, 'exportPDF']);
});
