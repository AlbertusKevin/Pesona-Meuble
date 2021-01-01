<?php
/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, Mikhael Adriel, December 2020
 */

use Illuminate\Support\Facades\Route;
use PharIo\Manifest\Email;

// Namespace controller yang akan digunakan
use App\Http\Controllers\Employee\AuthController;
use App\Http\Controllers\PagesController;

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

//=============================================================================================================
// Home and Display Product
//=============================================================================================================
Route::get('/', [PagesController::class, 'home_view_customer']);
Route::get('/meuble/{typeModel}', [PagesController::class, 'detail_meuble']);

//=============================================================================================================
// Domain Authentication and Login Employee
//=============================================================================================================
Route::get('/gate', [AuthController::class, 'login_view']);
Route::post('/gate', [AuthController::class, 'login_process']);
Route::get('/admin', [AuthController::class, 'home_admin'])->middleware('login_check');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('login_check');

//=============================================================================================================
// Domain Employee
//=============================================================================================================
Route::get('/employee/list', 'App\Domain\Employee\Service\EmployeeService@listView')->middleware('login_check');
Route::get('/employee/detail/{id}', 'App\Domain\Employee\Service\EmployeeService@detailView')->middleware('login_check');
Route::get('/employee/create', 'App\Domain\Employee\Service\EmployeeService@newEmployeeView')->middleware('login_check');
Route::get('/employee/update/{id}', 'App\Domain\Employee\Service\EmployeeService@updateView')->middleware('login_check');
Route::get('/employee/raise/{id}', 'App\Domain\Employee\Service\EmployeeService@raiseSalaryView')->middleware('login_check');

Route::post('/employee/create', 'App\Domain\Employee\Service\EmployeeService@addNewEmployee')->middleware('login_check');
Route::put('/employee/update/{id}', 'App\Domain\Employee\Service\EmployeeService@updateEmployee')->middleware('login_check');
Route::put('/employee/resign/{id}', 'App\Domain\Employee\Service\EmployeeService@resignEmployee')->middleware('login_check');
Route::put('/employee/raise/{id}', 'App\Domain\Employee\Service\EmployeeService@raiseSalary')->middleware('login_check');

//=============================================================================================================
// Domain Vendor
//=============================================================================================================
Route::get('/vendor/list/', 'App\Domain\Vendor\Service\VendorService@listView')->middleware('login_check');
Route::get('/vendor/detail/{companyCode}', 'App\Domain\Vendor\Service\VendorService@detailView')->middleware('login_check');
Route::get('/vendor/create', 'App\Domain\Vendor\Service\VendorService@createView')->middleware('login_check');
Route::get('/vendor/update/{companyCode}', 'App\Domain\Vendor\Service\VendorService@updateViewVendors')->middleware('login_check');

Route::post('/vendor/create', 'App\Domain\Vendor\Service\VendorService@addNewVendor')->middleware('login_check');
Route::put('/vendor/update/{companyCode}', 'App\Domain\Vendor\Service\VendorService@updateVendors')->middleware('login_check');
//=============================================================================================================
// Domain Customer
//=============================================================================================================
Route::get('/customer/list', 'App\Domain\CustomerManagement\Service\CustomerService@showCustomers')->middleware('login_check');
Route::get('/customer/create', 'App\Domain\CustomerManagement\Service\CustomerService@createViewCustomers')->middleware('login_check');
Route::get('/customer/update/{id}', 'App\Domain\CustomerManagement\Service\CustomerService@updateViewCustomers')->middleware('login_check');

Route::post('/customer/create', 'App\Domain\CustomerManagement\Service\CustomerService@createNewCustomer')->middleware('login_check');

Route::put('/customer/update/{id}', 'App\Domain\CustomerManagement\Service\CustomerService@updateCustomers')->middleware('login_check');
Route::put('/customer/member/{id}', 'App\Domain\CustomerManagement\Service\CustomerService@updateMemberCustomer')->middleware('login_check');

//=============================================================================================================
// Domain Sales
//=============================================================================================================
Route::get('/salesorder', 'App\Domain\Sales\Service\SalesOrderService@listView')->middleware('login_check');
Route::get('/salesorder/history/', 'App\Domain\Sales\Service\SalesOrderService@historyView')->middleware('login_check');
Route::get('/salesorder/create', 'App\Domain\Sales\Service\SalesOrderService@createView')->middleware('login_check');
Route::get('/salesorder/customer', 'App\Domain\CustomerManagement\Service\CustomerService@generateCustomerForSalesOrder')->middleware('login_check');
Route::get('/salesorder/detail/{numSO}', 'App\Domain\Sales\Service\SalesOrderService@salesOrderDetailView')->middleware('login_check');
Route::get('/salesorder/history/detail/{numSO}', 'App\Domain\Sales\Service\SalesOrderService@salesOrderDetaiHistory')->middleware('login_check');

Route::get('/delivery', 'App\Domain\Sales\Service\DeliveryService@index')->middleware('login_check');
Route::get('/delivery/detail/{num}', 'App\Domain\Sales\Service\DeliveryService@show')->middleware('login_check');
Route::patch('/delivery/detail/{num}', 'App\Domain\Sales\Service\DeliveryService@change')->middleware('login_check');
Route::get('/delivery/new/{num}', 'App\Domain\Sales\Service\DeliveryService@create')->middleware('login_check');
Route::post('/delivery/new/{num}', 'App\Domain\Sales\Service\DeliveryService@store')->middleware('login_check');

Route::post('/salesorder/create/header', 'App\Domain\Sales\Service\SalesOrderService@createHeader')->middleware('login_check');
Route::post('/salesorder/create/salesorderline', 'App\Domain\Sales\Service\SalesOrderLineService@createSalesOrderLine')->middleware('login_check');

Route::put('/salesorder/cancel/{numSO}', 'App\Domain\Sales\Service\SalesOrderService@cancelSO')->middleware('login_check');
Route::put('/salesorder/finish/{numSO}', 'App\Domain\Sales\Service\SalesOrderService@finishSO')->middleware('login_check');
Route::put('/salesorder/update/salesorderline', 'App\Domain\Sales\Service\SalesOrderLineService@updateSalesOrderLine')->middleware('login_check');

Route::patch('/salesorder/update/header', 'App\Domain\Sales\Service\SalesOrderService@updateHeader')->middleware('login_check');
Route::patch('/salesorder/proceed/{num}', 'App\Domain\Sales\Service\SalesOrderService@proceedSO')->middleware('login_check');
Route::patch('/salesorder/meuble', 'App\Domain\Procurement\Service\MeubleService@updateStockSO')->middleware('login_check');

Route::delete('/salesorder/item', 'App\Domain\Sales\Service\SalesOrderLineService@deleteLine')->middleware('login_check');

Route::get('/salesorder/meuble', 'App\Domain\Procurement\Service\MeubleService@generateMeubleData')->middleware('login_check');

//=============================================================================================================
// Domain Procurement
//=============================================================================================================
Route::get('/procurement/list', 'App\Domain\Procurement\Service\ProcurementService@showOpen')->middleware('login_check');
Route::get('/procurement/history', 'App\Domain\Procurement\Service\ProcurementService@showHistory')->middleware('login_check');
Route::get('/procurement/detail/{numPO}', 'App\Domain\Procurement\Service\ProcurementService@detail')->middleware('login_check');
Route::get('/procurement/history/detail/{numPO}', 'App\Domain\Procurement\Service\ProcurementService@detailHistory')->middleware('login_check');
Route::get('/procurement/create', 'App\Domain\Procurement\Service\ProcurementService@viewCreate')->middleware('login_check');

Route::post('/procurement/create', 'App\Domain\Procurement\Service\ProcurementLineService@insertLine')->middleware('login_check');
Route::post('/procurement/create/header', 'App\Domain\Procurement\Service\ProcurementService@createHeader')->middleware('login_check');

Route::put('/procurement/cancel/{num}', 'App\Domain\Procurement\Service\ProcurementService@cancelPO')->middleware('login_check');

Route::patch('/procurement/update/header', 'App\Domain\Procurement\Service\ProcurementService@updateHeader')->middleware('login_check');
Route::patch('/procurement/proceed/{num}', 'App\Domain\Procurement\Service\ProcurementService@proceedPO')->middleware('login_check');

Route::delete('/procurement/item', 'App\Domain\Procurement\Service\ProcurementLineService@deleteLine')->middleware('login_check');

//====================================================== Meuble ======================================================
Route::get('/procurement/meuble', 'App\Domain\Procurement\Service\MeubleService@generateMeubleData')->middleware('login_check');
Route::post('/procurement/meuble', 'App\Domain\Procurement\Service\MeubleService@insert')->middleware('login_check');
Route::patch('/procurement/meuble', 'App\Domain\Procurement\Service\MeubleService@updateStock')->middleware('login_check');

//=============================================================================================================
// Domain Finance
//=============================================================================================================
Route::get('/discount/list/', 'App\Domain\Finance\Service\DiscountService@listView')->middleware('login_check');
Route::get('/discount/detail/{code}', 'App\Domain\Finance\Service\DiscountService@detailView')->middleware('login_check');
Route::get('/discount/create', 'App\Domain\Finance\Service\DiscountService@createView')->middleware('login_check');

Route::post('/discount/create', 'App\Domain\Finance\Service\DiscountService@createNewDiscount')->middleware('login_check');
Route::put('/discount/update/{code}', 'App\Domain\Finance\Service\DiscountService@updateStatusDiscount')->middleware('login_check');
Route::delete('/discount/delete/{code}', 'App\Domain\Finance\Service\DiscountService@deleteDiscount')->middleware('login_check');

Route::get('/salesorder/invoice', 'App\Domain\Sales\Service\InvoiceSalesOrderService@listInvoiceSO')->middleware('login_check');
Route::post('/salesorder/invoice', 'App\Domain\Sales\Service\InvoiceSalesOrderService@createInvoiceSO')->middleware('login_check');
Route::get('/salesorder/invoice/detail/{numSO}', 'App\Domain\Sales\Service\InvoiceSalesOrderService@detailInvoiceSO')->middleware('login_check');

Route::get('/procurement/invoice', 'App\Domain\Procurement\Service\InvoiceProcurementService@listInvoicePO')->middleware('login_check');
Route::post('/procurement/invoice', 'App\Domain\Procurement\Service\InvoiceProcurementService@createInvoicePO')->middleware('login_check');
Route::get('/procurement/invoice/detail/{numPO}', 'App\Domain\Procurement\Service\InvoiceProcurementService@detailInvoicePO')->middleware('login_check');
