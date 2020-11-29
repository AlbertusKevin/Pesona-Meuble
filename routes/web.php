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
Route::get('/admin/{id}', 'App\Domain\Employee\Service\Login@homeAdmin');
//=============================================================================================================
// Domain Sales
//=============================================================================================================

Route::get('/salesorder', 'App\Domain\Sales\Service\SalesOrderService@listView');
Route::get('/salesorder/history/', 'App\Domain\Sales\Service\SalesOrderService@historyView');
Route::get('/salesorder/create/{id}', 'App\Domain\Sales\Service\SalesOrderService@createView');
Route::get('/salesorder/{numSO}', 'App\Domain\Sales\Service\SalesOrderService@salesOrderDetailView');
Route::post('/salesorder/create/salesorderline', 'App\Domain\Sales\Service\SalesOrderLineService@createSalesOrderLine');
Route::post('/salesorder/create/header', 'App\Domain\Sales\Service\SalesOrderService@createHeader');

Route::get('/salesorder/update', function () {
    return view('sales.sales_order.updateViewSalesOrder');
});

Route::get('/salesorder/meuble', 'App\Domain\Procurement\Service\MeubleService@generateMeubleForSalesOrder');

//=============================================================================================================
// Domain Procurement
//=============================================================================================================
Route::get('/procurement/menu/{id}', 'App\Domain\Procurement\Service\ProcurementService@show');
Route::get('/procurement/detail/{id}/{numPO}', 'App\Domain\Procurement\Service\ProcurementService@detail');
Route::get('/procurement/create/{id}', 'App\Domain\Procurement\Service\ProcurementService@viewCreate');
Route::post('/procurement/create/{id}', 'App\Domain\Procurement\Service\ProcurementService@create');
Route::post('/procurement/create/header/{id}', 'App\Domain\Procurement\Service\ProcurementService@createHeader');

Route::post('/procurement/meuble', 'App\Domain\Procurement\Service\MeubleService@insert');
Route::get('/procurement/meuble', 'App\Domain\Procurement\Service\MeubleService@generateMeubleForProcurement');
//=============================================================================================================
// Domain Financial
//=============================================================================================================


//=============================================================================================================
// Domain Employee
//=============================================================================================================

//=============================================================================================================
// Domain Vendor
//=============================================================================================================

//=============================================================================================================
// Domain Customer
//=============================================================================================================

Route::get('/meuble/{typeModel}', function ($typeModel) {
    $meuble = MeubleDao::findMeubleByModelType($typeModel);
    return view('customer_service.customer_data.customer')->with('meuble', $meuble);
});

Route::get('/customerlist', function () {
    return view('customerlist');
});

Route::get('/updatecustomer', function () {
    return view('updatecustomer');
});

Route::get('/warrantylist', function () {
    return view('warrantylist');
});



Route::get('/shipmentlist', function () {
    return view('shipmentlist');
});
Route::get('/employeelist', function () {
    return view('employeelist');
});
Route::get('/discountlist', function () {
    return view('discountlist');
});
Route::get('/updatestaff', function () {
    return view('updatestaff');
});
Route::get('/customerprofile', function () {
    return view('customerprofile');
});
Route::get('/updateviewSalesOrder', function () {
    return view('updateViewSalesOrder');
});
Route::get('/historySalesOrder', function () {
    return view('historySalesOrder');
});
Route::get('/listOfProcurement', function () {
    return view('listOfProcurement');
});
Route::get('/createPurchaseOrder', function () {
    return view('createPurchaseOrder');
});
Route::get('/updateviewPurchaseOrder', function () {
    return view('updateViewPurchaseOrder');
});
Route::get('/historyOfProcurement', function () {
    return view('historyOfProcurement');
});
Route::get('/createShipment', function () {
    return view('createShipment');
});
Route::get('/updateShipment', function () {
    return view('updateShipment');
});
Route::get('/newEmployee', function () {
    return view('newEmployee');
});
Route::get('/editEmployee', function () {
    return view('editEmployee');
});
Route::get('/newWarranty', function () {
    return view('newWarranty');
});
Route::get('/editWarranty', function () {
    return view('editWarranty');
});
Route::get('/employeeDetail', function () {
    return view('employee_service.employee_data.employeeDetail');
});
Route::get('/warrantyDetail', function () {
    return view('warrantyDetail');
});
Route::get('/shipmentDetail', function () {
    return view('shipmentDetail');
});
Route::get('/staffprofile', function () {
    return view('staffprofile');
});
Route::get('/discountDetail', function () {
    return view('discountDetail');
});
Route::get('/newDiscount', function () {
    return view('newDiscount');
});
Route::get('/updateDiscount', function () {
    return view('updateDiscount');
});
