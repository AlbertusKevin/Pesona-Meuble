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
Route::get('/', function () {
    $meubles = MeubleDao::findAllMeubles();
    return view('home')->with('meubles', $meubles);
});

//=============================================================================================================
// Domain Employee
//=============================================================================================================
Route::get('/gate', 'App\Domain\Employee\Service\Login@login_view');
Route::post('/gate', 'App\Domain\Employee\Service\Login@login_process');

Route::get('/admin', function () {
    return view('employee_service.home');
});

//=============================================================================================================
// Domain Sales
//=============================================================================================================

Route::get('/salesorder', function () {
    $salesorders = SalesOrderDao::findAllSalesOrders();
    return view('sales.sales_order.listSalesOrder')->with('salesorders', $salesorders);
});

Route::get('/salesorder/history', function () {
    $salesorders = SalesOrderDao::findAllSalesOrders();
    return view('sales.sales_order.historySalesOrder')->with('salesorders', $salesorders);
});

Route::get('/salesorder/create', function () {
    $meubles = MeubleDao::findAllMeubles();
    $employees = Employee::all();
    $discounts = Discount::all();
    return view('sales.sales_order.createSalesOrder', [
        'meubles' => $meubles,
        'employees' => $employees,
        'discounts' => $discounts,
    ]);
});


Route::post('/salesorder', function (Request $request) {

    $validator = Validator::make($request->all(), [
        'numSO' => 'required|min:4|unique:numSO',
        'customer' => 'required',
        'employee' => 'required',
        'date' => 'required',
        'validTo' => 'required',
        'totalItem' => 'required',
        'totalPrice' => 'required',
        'totalDiscount' => 'required',
        'totalPayment' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect('/salesorder/create')
            ->withInput()
            ->withErrors($validator);
    }

    SalesOrderDao::createSalesOrder($request);
    return redirect('/salesorder')->with(['success' => 'Sales Order Created !']);
});

Route::get('/salesorder/update', function () {
    return view('sales.sales_order.updateViewSalesOrder');
});

Route::get('/salesorder/{numSO}', function ($numSO) {
    $salesorder = SalesOrderDao::findSalesOrderByNumSO($numSO);
    return view('sales.sales_order.salesOrderDetail')->with('salesorder', $salesorder);
});

//=============================================================================================================
// Domain Procurement
//=============================================================================================================
Route::get('/procurement/menu', 'App\Domain\Procurement\Service\ProcurementService@listProcurement');
Route::get('/procurement/detail', 'App\Domain\Procurement\Service\ProcurementService@detail_updateProcurement');
Route::get('/procurement/create', 'App\Domain\Procurement\Service\ProcurementService@createProcurement');


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
