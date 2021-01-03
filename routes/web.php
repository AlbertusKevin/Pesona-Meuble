<?php
/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, Mikhael Adriel, December 2020
 */

use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\DiscountController;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\Email;

// Namespace controller yang akan digunakan
use App\Http\Controllers\Employee\AuthController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Finance\InvoicePurchaseOrderController;
use App\Http\Controllers\Finance\InvoiceSalesOrderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Procurement\ProcurementController;
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

// !=================================== Domain Authentication and Login Employee ===================================
Route::get('/gate', [AuthController::class, 'login_view']);
Route::post('/gate', [AuthController::class, 'login_process']);

//! =====================================Domain Warehouse: Meuble =============================================
Route::get('/', [MeubleController::class, 'home_customer']);
Route::get('/meuble/{typeModel}', [MeubleController::class, 'detail_meuble']);

//?=============================================================================================================
//* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Dalam middleware ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//?=============================================================================================================
Route::group(['middleware' => 'login_check'], function () {
    // !=================================== Domain Authentication and Login Employee ===================================
    Route::get('/admin', [AuthController::class, 'home_admin']);
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

    Route::get('/vendor/update/{companyCode}', [VendorController::class, 'edit']);
    Route::patch('/vendor/{companyCode}', [VendorController::class, 'update']);

    // !=================================== Domain Customer ===================================
    Route::get('/customer', [CustomerController::class, 'index']);
    Route::get('/customer/search', [CustomerController::class, 'search']);

    Route::get('/customer/create', [CustomerController::class, 'create']);
    Route::post('/customer', [CustomerController::class, 'store']);

    Route::get('/customer/update/{id}', [CustomerController::class, 'edit']);
    Route::patch('/customer/update/{id}', [CustomerController::class, 'update']);
    Route::patch('/customer/member/{id}', [CustomerController::class, 'update_member']);

    // !=================================== Domain Procurement ===================================
    Route::get('/procurement/create', [ProcurementController::class, 'create']);
    Route::get('/procurement', [ProcurementController::class, 'index']);
    Route::get('/procurement/history', [ProcurementController::class, 'index_history']);
    Route::get('/procurement/{numPO}', [ProcurementController::class, 'show']);

    Route::post('/procurement', [ProcurementController::class, 'store']);
    Route::post('/procurement/line', [ProcurementLController::class, 'store_line']);

    Route::patch('/procurement/cancel/{num}', [ProcurementLController::class, 'cancel']);
    Route::patch('/procurement/proceed/{num}', [ProcurementLController::class, 'proceed']);
    Route::patch('/procurement', [ProcurementLController::class, 'update']);

    Route::delete('/procurement/line', [ProcurementLController::class, 'destroy']);

    //? ==============================================================================================
    //* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ FINANCE DOMAIN ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    //? ==============================================================================================
    //! ================================== Domain Finance: Discount ==================================
    Route::get('/discount/create', [DiscountController::class, 'create']);
    Route::post('/discount', [DiscountController::class, 'store']);

    Route::get('/discount', [DiscountController::class, 'index']);
    Route::get('/discount/{code}', [DiscountController::class, 'show']);

    Route::patch('/discount/{code}', [DiscountController::class, 'update']);
    Route::delete('/discount/{code}', [DiscountController::class, 'destroy']);

    // !=============================== Domain Finance: Invoice Sales Order ===============================
    Route::post('/salesorder/invoice', [InvoiceSalesOrderController::class, 'store']);
    Route::get('/salesorder/invoice', [InvoiceSalesOrderController::class, 'index']);
    Route::get('/salesorder/invoice/{numSO}', [InvoiceSalesOrderController::class, 'show']);

    // !=============================== Domain Finance: Invoice Purchase Order ===============================
    Route::post('/procurement/invoice', [InvoicePurchaseOrderController::class, 'store']);
    Route::get('/procurement/invoice', [InvoicePurchaseOrderController::class, 'index']);
    Route::get('/procurement/invoice/{numPO}', [InvoicePurchaseOrderController::class, 'show']);

    //? ==============================================================================================
    //* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ WAREHOUSE DOMAIN ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    //? ==============================================================================================
    //! =====================================Domain Warehouse: Meuble =============================================
    Route::get('/meuble', [MeubleController::class, 'search_meuble']);
    Route::post('/meuble', [MeubleController::class, 'store']);
    Route::patch('/meuble/add', [MeubleController::class, 'add_stock']);
    Route::patch('/meuble/reduce', [MeubleController::class, 'reduce_stock']);

    //! =====================================Domain Warehouse: Delivery =============================================
    Route::get('/delivery/create/{num}', [DeliveryController::class, 'create'])->middleware('login_check');
    Route::get('/delivery', [DeliveryController::class, 'index'])->middleware('login_check');
    Route::get('/delivery/{num}', [DeliveryController::class, 'show'])->middleware('login_check');
    Route::post('/delivery/{num}', [DeliveryController::class, 'store'])->middleware('login_check');
});

//todo: belum ada url dari gui yang mengarah ke route ini
Route::patch('/delivery/detail/{num}', 'App\Domain\Sales\Service\DeliveryService@change')->middleware('login_check');

//=============================================================================================================
// Domain Sales
//=============================================================================================================
Route::get('/salesorder', 'App\Domain\Sales\Service\SalesOrderService@listView')->middleware('login_check');
Route::get('/salesorder/history/', 'App\Domain\Sales\Service\SalesOrderService@historyView')->middleware('login_check');
Route::get('/salesorder/create', 'App\Domain\Sales\Service\SalesOrderService@createView')->middleware('login_check');
Route::get('/salesorder/detail/{numSO}', 'App\Domain\Sales\Service\SalesOrderService@salesOrderDetailView')->middleware('login_check');
Route::get('/salesorder/history/detail/{numSO}', 'App\Domain\Sales\Service\SalesOrderService@salesOrderDetaiHistory')->middleware('login_check');

Route::post('/salesorder/create/header', 'App\Domain\Sales\Service\SalesOrderService@createHeader')->middleware('login_check');
Route::post('/salesorder/create/salesorderline', 'App\Domain\Sales\Service\SalesOrderLineService@createSalesOrderLine')->middleware('login_check');

Route::patch('/salesorder/cancel/{numSO}', 'App\Domain\Sales\Service\SalesOrderService@cancelSO')->middleware('login_check');
Route::put('/salesorder/finish/{numSO}', 'App\Domain\Sales\Service\SalesOrderService@finishSO')->middleware('login_check');
Route::put('/salesorder/update/salesorderline', 'App\Domain\Sales\Service\SalesOrderLineService@updateSalesOrderLine')->middleware('login_check');

Route::patch('/salesorder/update/header', 'App\Domain\Sales\Service\SalesOrderService@updateHeader')->middleware('login_check');
Route::patch('/salesorder/proceed/{num}', 'App\Domain\Sales\Service\SalesOrderService@proceedSO')->middleware('login_check');

Route::delete('/salesorder/item', 'App\Domain\Sales\Service\SalesOrderLineService@deleteLine')->middleware('login_check');
