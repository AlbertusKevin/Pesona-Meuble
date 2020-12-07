<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, Mikhael Adriel, December 2020
 */

use App\Domain\Employee\Entity\Employee;
use App\Domain\Finance\Entity\Discount;
use App\Domain\Procurement\Dao\MeubleDao;
use App\Domain\Sales\Dao\SalesOrderDao;
use Illuminate\Support\Facades\Route;

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
Route::get('/', 'App\Domain\Procurement\Service\MeubleService@homeView');
Route::get('/meuble/{typeModel}', 'App\Domain\Procurement\Service\MeubleService@meubleDetailView');

//=============================================================================================================
// Domain Employee
//=============================================================================================================
Route::get('/gate', 'App\Domain\Employee\Service\Login@login_view');
Route::post('/gate', 'App\Domain\Employee\Service\Login@login_process');
Route::get('/logout', 'App\Domain\Employee\Service\Login@logout')->middleware('login_check');
Route::get('/admin', 'App\Domain\Employee\Service\Login@homeAdmin')->middleware('login_check');
//=============================================================================================================
// Domain Sales
//=============================================================================================================

Route::get('/salesorder', 'App\Domain\Sales\Service\SalesOrderService@listView')->middleware('login_check');
Route::get('/salesorder/history/', 'App\Domain\Sales\Service\SalesOrderService@historyView')->middleware('login_check');
Route::get('/salesorder/create', 'App\Domain\Sales\Service\SalesOrderService@createView')->middleware('login_check');
Route::get('/salesorder/customer', 'App\Domain\CustomerManagement\Service\CustomerService@generateCustomerForSalesOrder')->middleware('login_check');
Route::get('/salesorder/detail/{numSO}', 'App\Domain\Sales\Service\SalesOrderService@salesOrderDetailView')->middleware('login_check');
Route::get('/salesorder/history/detail/{numSO}', 'App\Domain\Sales\Service\SalesOrderService@salesOrderDetaiHistory')->middleware('login_check');
Route::get('/salesorder/meuble', 'App\Domain\Procurement\Service\MeubleService@generateMeubleForSalesOrder')->middleware('login_check');

Route::post('/salesorder/create/header', 'App\Domain\Sales\Service\SalesOrderService@createHeader')->middleware('login_check');
Route::post('/salesorder/create/salesorderline', 'App\Domain\Sales\Service\SalesOrderLineService@createSalesOrderLine')->middleware('login_check');

Route::put('/salesorder/proceed/{numSO}', 'App\Domain\Sales\Service\SalesOrderService@proceedSO')->middleware('login_check');
Route::put('/salesorder/cancel/{numSO}', 'App\Domain\Sales\Service\SalesOrderService@cancelSO')->middleware('login_check');
Route::put('/salesorder/finish/{numSO}', 'App\Domain\Sales\Service\SalesOrderService@finishSO')->middleware('login_check');
Route::put('/salesorder/update/header', 'App\Domain\Sales\Service\SalesOrderService@updateHeader')->middleware('login_check');
Route::put('/salesorder/update/salesorderline', 'App\Domain\Sales\Service\SalesOrderLineService@updateSalesOrderLine')->middleware('login_check');

Route::get('/salesorder/meuble', 'App\Domain\Procurement\Service\MeubleService@generateMeubleForSalesOrder')->middleware('login_check');

//=============================================================================================================
// Domain Procurement
//=============================================================================================================
Route::get('/procurement/list', 'App\Domain\Procurement\Service\ProcurementService@showOpen')->middleware('login_check');
Route::get('/procurement/history', 'App\Domain\Procurement\Service\ProcurementService@showHistory')->middleware('login_check');
Route::get('/procurement/detail/{numPO}', 'App\Domain\Procurement\Service\ProcurementService@detail')->middleware('login_check');
Route::get('/procurement/history/detail/{numPO}', 'App\Domain\Procurement\Service\ProcurementService@detailHistory')->middleware('login_check');
Route::get('/procurement/create', 'App\Domain\Procurement\Service\ProcurementService@viewCreate')->middleware('login_check');
Route::get('/procurement/meuble', 'App\Domain\Procurement\Service\MeubleService@generateMeubleForProcurement')->middleware('login_check');

Route::post('/procurement/create', 'App\Domain\Procurement\Service\ProcurementService@create')->middleware('login_check');
Route::post('/procurement/create/header', 'App\Domain\Procurement\Service\ProcurementService@createHeader')->middleware('login_check');
Route::post('/procurement/meuble', 'App\Domain\Procurement\Service\MeubleService@insert')->middleware('login_check');

Route::put('/procurement/proceed/{num}', 'App\Domain\Procurement\Service\ProcurementService@proceedPO')->middleware('login_check');
Route::put('/procurement/cancel/{num}', 'App\Domain\Procurement\Service\ProcurementService@cancelPO')->middleware('login_check');
Route::put('/procurement/update/header', 'App\Domain\Procurement\Service\ProcurementService@updateHeader')->middleware('login_check');
Route::put('/procurement/update', 'App\Domain\Procurement\Service\ProcurementService@updateLine')->middleware('login_check');


//=============================================================================================================
// Domain Financial
//=============================================================================================================
Route::post('/salesorder/new_line/{numSO}', 'App\Domain\Sales\Service\SalesOrderLineService@addNewLineItem')->middleware('login_check');
Route::post('/procurement/new_line/{numPO}', 'App\Domain\Procurement\Service\ProcurementService@addNewLineItem')->middleware('login_check');
Route::delete('/salesorder/delete_line/{numSO}/{mode}', 'App\Domain\Sales\Service\SalesOrderLineService@deleteNewLineItem')->middleware('login_check');
Route::delete('/procurement/delete_line/{numPO}/{mode}', 'App\Domain\Procurement\Service\ProcurementService@deleteNewLineItem')->middleware('login_check');
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
Route::get('/vendor/update/{companyCode}', 'App\Domain\Vendor\Service\VendorService@updateViewVendors');

Route::post('/vendor/create', 'App\Domain\Vendor\Service\VendorService@addNewVendor')->middleware('login_check');
Route::put('/vendor/update/{companyCode}', 'App\Domain\Vendor\Service\VendorService@updateVendors');
//=============================================================================================================
// Domain Customer
//=============================================================================================================


Route::get('/customer/list', 'App\Domain\CustomerManagement\Service\CustomerService@showCustomers');
Route::get('/customer/create', 'App\Domain\CustomerManagement\Service\CustomerService@createViewCustomers');
Route::get('/customer/update/{id}', 'App\Domain\CustomerManagement\Service\CustomerService@updateViewCustomers');

Route::post('/customer/create', 'App\Domain\CustomerManagement\Service\CustomerService@createNewCustomer')->middleware('login_check');

Route::put('/customer/update/{id}', 'App\Domain\CustomerManagement\Service\CustomerService@updateCustomers');
