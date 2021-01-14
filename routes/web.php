<?php
/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, Mikhael Adriel, December 2020
 */

use Illuminate\Support\Facades\Route;
use PharIo\Manifest\Email;

// Namespace controller yang akan digunakan
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\WarrantyController;
use App\Http\Controllers\Finance\DiscountController;
use App\Http\Controllers\Employee\AuthController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Finance\InvoicePurchaseOrderController;
use App\Http\Controllers\Finance\InvoiceSalesOrderController;
use App\Http\Controllers\Procurement\ProcurementController;
use App\Http\Controllers\Sales\SalesOrderController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Warehouse\DeliveryController;
use App\Http\Controllers\Warehouse\MeubleController;

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
//?=============================================================================================================
//* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Dalam middleware ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//?=============================================================================================================

Route::group(['middleware' => 'login_check'], function () {
    // !=================================== Domain Authentication and Login Employee ===================================
    Route::get('/logout', [AuthController::class, 'logout']);

    // !=================================== Domain Employee ===================================
    Route::get('/employee/create', [EmployeeController::class, 'create']);
    Route::post('/employee', [EmployeeController::class, 'store']);

    Route::get('/employee', [EmployeeController::class, 'index']);
    Route::get('/employee/{id}', [EmployeeController::class, 'show']);

    Route::get('/employee/update/{id}', [EmployeeController::class, 'edit']);
    Route::patch('/employee/{id}', [EmployeeController::class, 'update']);

    Route::get('/employee/raise/{id}', [EmployeeController::class, 'edit_salary']);
    Route::patch('/employee/raise/{id}', [EmployeeController::class, 'update_salary']);

    Route::patch('/employee/resign/{id}', [EmployeeController::class, 'update_active_status']);

    // !=================================== Domain Vendor ===================================
    Route::get('/vendor/create', [VendorController::class, 'create']);
    Route::post('/vendor', [VendorController::class, 'store']);

    Route::get('/vendor', [VendorController::class, 'index']);
    Route::get('/vendor/{companyCode}', [VendorController::class, 'show']);

    Route::patch('/vendor/status/{companyCode}/{status}', [VendorController::class, 'change_status']);

    Route::get('/vendor/update/{companyCode}', [VendorController::class, 'edit']);
    Route::patch('/vendor/{companyCode}', [VendorController::class, 'update']);

    //? ==============================================================================================
    //* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ CUSTOMER DOMAIN ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    //? ==============================================================================================
    // !=================================== Domain Customer: Customer Data ===================================
    Route::get('/customer', [CustomerController::class, 'index']);
    Route::get('/customer/search', [CustomerController::class, 'search']);
    Route::get('/customer/{id}', [CustomerController::class, 'show']);

    Route::get('/customer/create', [CustomerController::class, 'create']);
    Route::post('/customer', [CustomerController::class, 'store']);

    Route::get('/customer/update/{id}', [CustomerController::class, 'edit']);
    Route::patch('/customer/update/{id}', [CustomerController::class, 'update']);

    // !=================================== Domain Customer: Warranty ===================================
    Route::get('/warranty', [WarrantyController::class, 'index']);
    Route::get('/warranty/create', [WarrantyController::class, 'create']);
    Route::get('/warranty/quantity', [WarrantyController::class, 'check_quantity']);
    Route::post('/warranty/{numSO}', [WarrantyController::class, 'store']);
    Route::get('/warranty/{num}/{model}', [WarrantyController::class, 'show']);
    Route::get('/warranty/update/{num}/{model}', [WarrantyController::class, 'edit']);

    Route::patch('/warranty/{num}/{model}', [WarrantyController::class, 'update']);
    Route::patch('/warranty/status/{num}/{model}', [WarrantyController::class, 'update_status']);


    //? ==============================================================================================
    //* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ FINANCE DOMAIN ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    //? ==============================================================================================
    //! ================================== Domain Finance: Discount ==================================
    Route::get('/discount/create', [DiscountController::class, 'create']);
    Route::post('/discount', [DiscountController::class, 'store']);

    Route::get('/discount', [DiscountController::class, 'index']);
    Route::get('/discount/update/{code}', [DiscountController::class, 'edit']);
    Route::get('/discount/{code}', [DiscountController::class, 'show']);

    Route::patch('/discount/status/{code}', [DiscountController::class, 'update']);
    Route::patch('/discount/{code}', [DiscountController::class, 'update_data']);
    Route::delete('/discount/{code}', [DiscountController::class, 'destroy']);

    // !=============================== Domain Finance: Invoice Sales Order ===============================
    Route::post('/salesorder/invoice', [InvoiceSalesOrderController::class, 'store']);
    Route::get('/salesorder/invoice', [InvoiceSalesOrderController::class, 'index']);
    Route::get('/salesorder/invoice/{numSO}', [InvoiceSalesOrderController::class, 'show']);

    // !=============================== Domain Finance: Invoice Purchase Order ===============================
    Route::get('/procurement/invoice', [InvoicePurchaseOrderController::class, 'index']);
    Route::get('/procurement/invoice/{numPO}', [InvoicePurchaseOrderController::class, 'show']);
    Route::post('/procurement/invoice', [InvoicePurchaseOrderController::class, 'store']);
    Route::patch('/procurement/invoice/{numPO}', [InvoicePurchaseOrderController::class, 'update']);

    // !=================================== Domain Procurement ===================================
    Route::get('/procurement/create', [ProcurementController::class, 'create']);
    Route::get('/procurement', [ProcurementController::class, 'index']);
    Route::get('/procurement/history', [ProcurementController::class, 'index_history']);
    Route::get('/procurement/{numPO}', [ProcurementController::class, 'show']);

    Route::post('/procurement', [ProcurementController::class, 'store']);
    Route::post('/procurement/line', [ProcurementController::class, 'store_line']);

    Route::patch('/procurement/cancel/{num}', [ProcurementController::class, 'cancel']);
    Route::patch('/procurement/proceed/{num}', [ProcurementController::class, 'proceed']);
    Route::patch('/procurement', [ProcurementController::class, 'update']);

    Route::delete('/procurement/line', [ProcurementController::class, 'destroy']);

    //!======================================= Domain Sales =======================================
    Route::get('/salesorder', [SalesOrderController::class, 'index'])->middleware('login_check');
    Route::get('/salesorder/history', [SalesOrderController::class, 'index_history'])->middleware('login_check');

    Route::get('/salesorder/create', [SalesOrderController::class, 'create'])->middleware('login_check');
    Route::post('/salesorder', [SalesOrderController::class, 'store'])->middleware('login_check');
    Route::post('/salesorder/line', [SalesOrderController::class, 'store_line'])->middleware('login_check');

    Route::get('/salesorder/{numSO}', [SalesOrderController::class, 'show'])->middleware('login_check');

    Route::patch('/salesorder/cancel/{numSO}', [SalesOrderController::class, 'cancel'])->middleware('login_check');
    Route::patch('/salesorder/proceed/{num}', [SalesOrderController::class, 'proceed'])->middleware('login_check');

    Route::patch('/salesorder', [SalesOrderController::class, 'update'])->middleware('login_check');
    Route::delete('/salesorder', [SalesOrderController::class, 'destroy'])->middleware('login_check');

    //? ==============================================================================================
    //* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ WAREHOUSE DOMAIN ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    //? ==============================================================================================
    //! =====================================Domain Warehouse: Meuble =============================================
    Route::get('/meuble/update/{model}', [MeubleController::class, 'edit']);
    Route::get('/meuble/create', [MeubleController::class, 'create']);
    Route::get('/meuble', [MeubleController::class, 'home_admin']);
    Route::get('/meuble/search', [MeubleController::class, 'search_meuble']);
    Route::patch('/meuble/add', [MeubleController::class, 'add_stock']);
    Route::patch('/meuble/reduce', [MeubleController::class, 'reduce_stock']);
    Route::post('/meuble', [MeubleController::class, 'store']);
    Route::put('/meuble/{model}', [MeubleController::class, 'update']);
    Route::patch('/meuble/sale/{model}', [MeubleController::class, 'sale_again']);
    Route::patch('/meuble/{model}', [MeubleController::class, 'soft_delete']);


    //! =====================================Domain Warehouse: Delivery =============================================
    Route::get('/delivery/create/{num}', [DeliveryController::class, 'create']);
    Route::get('/delivery', [DeliveryController::class, 'index']);
    Route::get('/delivery/{num}', [DeliveryController::class, 'show']);

    Route::post('/delivery/{num}', [DeliveryController::class, 'store']);

    Route::patch('/delivery/sent/{num}', [DeliveryController::class, 'update']);
    Route::patch('/delivery/complete/{numSO}', [DeliveryController::class, 'update_complete_status']);
});

// !=================================== Domain Authentication and Login Employee ===================================
Route::get('/gate', [AuthController::class, 'login_view']);
Route::post('/gate', [AuthController::class, 'login_process']);

//! =====================================Domain Warehouse: Meuble =============================================
Route::get('/', [MeubleController::class, 'index']);
Route::get('/meuble/{typeModel}', [MeubleController::class, 'show']);
