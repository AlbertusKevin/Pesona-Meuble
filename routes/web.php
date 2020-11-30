<?php

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
Route::get('/salesorder/create/{id}', 'App\Domain\Sales\Service\SalesOrderService@createView')->middleware('login_check');
Route::get('/salesorder/customer', 'App\Domain\CustomerManagement\Service\CustomerService@generateCustomerForSalesOrder')->middleware('login_check');
Route::post('/salesorder/create/salesorderline', 'App\Domain\Sales\Service\SalesOrderLineService@createSalesOrderLine')->middleware('login_check');
Route::post('/salesorder/create/header', 'App\Domain\Sales\Service\SalesOrderService@createHeader')->middleware('login_check');
Route::get('/salesorder/{numSO}', 'App\Domain\Sales\Service\SalesOrderService@salesOrderDetailView')->middleware('login_check');

Route::get('/salesorder/update', function () {
    return view('sales.sales_order.updateViewSalesOrder');
})->middleware('login_check');

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


//=============================================================================================================
// Domain Employee
//=============================================================================================================

//=============================================================================================================
// Domain Vendor
//=============================================================================================================
Route::get('/vendor/menu/{id}', 'App\Domain\Vendor\Service\VendorService@show')->middleware('login_check');
Route::get('/vendor/detail/{id}', 'App\Domain\Vendor\Service\VendorService@detail')->middleware('login_check');
Route::post('/vendor/create/{id}', 'App\Domain\Vendor\Service\VendorService@create')->middleware('login_check');
Route::get('/vendor/edit/{id}', 'App\Domain\Vendor\Service\VendorService@edit')->middleware('login_check');

//=============================================================================================================
// Domain Customer
//=============================================================================================================

Route::post('/customer/create', 'App\Domain\CustomerManagement\Service\CustomerService@createNewCustomer')->middleware('login_check');

Route::get('/meuble/{typeModel}', function ($typeModel) {
    $meuble = MeubleDao::findMeubleByModelType($typeModel);
    return view('customer_service.customer_data.customer')->with('meuble', $meuble);
});
