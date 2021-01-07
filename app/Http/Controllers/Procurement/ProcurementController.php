<?php

namespace App\Http\Controllers\Procurement;

use App\Domain\Employee\Service\EmployeeService;
use App\Domain\Procurement\Service\ProcurementLineService;
use App\Domain\Procurement\Service\ProcurementService;
use App\Domain\Vendor\Service\VendorService;
use App\Domain\Warehouse\Service\MeubleService;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ProcurementController extends Controller
{
    private $procurement_service;
    private $procurement_line_service;
    private $employee_service;
    private $vendor_service;
    private $meuble_service;

    public function __construct()
    {
        $this->procurement_service = new ProcurementService;
        $this->procurement_line_service = new ProcurementLineService;
        $this->employee_service = new EmployeeService;
        $this->meuble_service = new MeubleService;
        $this->vendor_service = new VendorService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procurement = $this->procurement_service->index_open();
        return view('procurement.listOfProcurement', [
            "procurement" => $procurement
        ]);
    }
    public function index_history(Request $request)
    {
        $procurement = $this->procurement_service->index_history();
        return view('procurement.historyOfProcurement', [
            "procurement" => $procurement
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $vendor = $this->vendor_service->index();
        $employee = $this->employee_service->get_employee_by_id($request->session()->get("id_employee"));
        $meuble = $this->meuble_service->index_category();
        $numPO = $this->procurement_service->get_last_numPO();

        return view('procurement.createPurchaseOrder', [
            "employee" => $employee,
            "vendor" => $vendor,
            "category" => $meuble,
            "num" => $numPO
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
        $this->procurement_service->store($request);
    }

    public function store_line(Request $request)
    {
        $this->procurement_line_service->store_line($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $numPO)
    {
        $detailProcurement = $this->procurement_service->show_header($numPO);
        $detailProcurementLine = $this->procurement_line_service->show_line($numPO);
        $employee = $this->employee_service->get_employee_by_id($request->session()->get('id_employee'));

        return view('procurement.detailPurchaseOrder', [
            "po" => $detailProcurement,
            "line" => $detailProcurementLine,
            "employee" => $employee
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
        $this->procurement_service->update($request);
    }

    public function proceed($num)
    {
        $this->procurement_service->proceed($num);
    }

    public function cancel($num)
    {
        $this->procurement_service->cancel($num);
        return redirect('/procurement')->with('cancel_po', 'Purchase Order ' . $num . ' canceled!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->procurement_line_service->delete_line($request);
    }
}
