<?php

namespace App\Http\Controllers\Sales;

use App\Domain\Employee\Service\EmployeeService;
use App\Domain\Sales\Service\SalesOrderLineService;
use App\Domain\Sales\Service\SalesOrderService;
use App\Domain\Warehouse\Service\MeubleService;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SalesOrderController extends Controller
{
    private $salesorder_service;
    private $salesorder_line_service;
    private $meuble_service;
    private $employee_service;

    public function __construct()
    {
        $this->salesorder_service = new SalesOrderService;
        $this->salesorder_line_service = new SalesOrderLineService;
        $this->meuble_service = new MeubleService;
        $this->employee_service = new EmployeeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salesorders = $this->salesorder_service->index();
        return view('sales.sales_order.listSalesOrder', [
            'salesorders' => $salesorders,
        ]);
    }

    public function index_history()
    {
        $salesorders = $this->salesorder_service->index_history();
        return view('sales.sales_order.historySalesOrder', [
            'salesorders' => $salesorders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $meubles = $this->meuble_service->index_meuble();
        $employee = $this->employee_service->get_employee_by_id($request->session()->get('id_employee'));
        // $discMeuble = $this->discounts->forMeuble();
        // $discPayment = $this->discounts->forPayment();
        $numSO = $this->salesorder_service->get_last_numSO();

        return view('sales.sales_order.createSalesOrder', [
            'meubles' => $meubles,
            'employee' => $employee,
            // 'discMeuble' => $discMeuble,
            // 'discPayment' => $discPayment,
            'numSO' => $numSO
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->salesorder_service->store_header($request);
    }
    public function store_line(Request $request)
    {
        $this->salesorder_line_service->store_line($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($numSO)
    {
        $salesorder = $this->salesorder_service->get_by_customer_and_numSO($numSO);
        // $discounts = $this->discounts->showAllDiscount();
        $salesorderlines = $this->salesorder_line_service->show_line($numSO);

        return view('sales.sales_order.updateSalesOrderView', [
            'salesorder' => $salesorder,
            'salesorderlines' => $salesorderlines
            // 'discounts' => $discounts
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->salesorder_service->update_header($request);
    }

    public function cancel($id)
    {
        $this->salesorder_service->cancel($id);
        return redirect('/salesorder')->with(['success' => 'Sales Order  ' . $id . ' canceled !']);
    }

    public function proceed($id)
    {
        $this->salesorder_service->proceed($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->salesorder_line_service->delete_line($request);
    }
}
