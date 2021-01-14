<?php

namespace App\Http\Controllers\Customer;

use App\Domain\CustomerManagement\Service\WarrantyService;
use App\Domain\Employee\Service\EmployeeService;
use App\Domain\Finance\Service\InvoiceSalesOrderService;
use App\Domain\Sales\Service\SalesOrderLineService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WarrantyController extends Controller
{
    private $warranty_service;
    private $employee_service;
    private $salesorder_line_service;
    private $invoice_service;

    public function __construct()
    {
        $this->warranty_service = new WarrantyService;
        $this->employee_service = new EmployeeService;
        $this->salesorder_line_service = new SalesOrderLineService;
        $this->invoice_service = new InvoiceSalesOrderService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warranties = $this->warranty_service->index();
        return view('customer_service.warranty.warrantylist', compact('warranties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect('/warranty')
                ->withInput()
                ->withErrors($validator);
        }

        $items = $this->invoice_service->show_line($request->number);
        if (count($items) == 0) {
            return redirect('/warranty')->with('error', "There's no invoice with that number. Please recheck your input!");
        }

        $items = $this->salesorder_line_service->show_line($request->number);
        $claimed = $this->warranty_service->get_by_numSO($request->number);

        $data = [];
        $isExist = false;

        foreach ($items as $item) {
            foreach ($claimed as $claim) {
                if ($item->numSO == $claim->numSO && $item->modelType == $claim->modelType) {
                    $isExist = true;
                    break;
                }
            }

            if (!$isExist) {
                $data[] = $item;
            }
        }

        $numSO = $request->number;

        return view('customer_service.warranty.newWarranty', compact('data', 'claimed', 'numSO'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $numSO)
    {
        $validator = Validator::make($request->all(), [
            'quantity.*' => 'required|numeric',
            'information.*' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/warranty/create?number=' . $numSO)
                ->withInput()
                ->withErrors($validator);
        }

        $this->warranty_service->store($request, $numSO, $request->session()->get('id_employee'));

        return redirect('/warranty')->with('success', 'warranty input successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $numSO, $modelType)
    {
        $warranty = $this->warranty_service->show($numSO, $modelType);
        $employee = $this->employee_service->get_employee_by_id($request->session()->get('id_employee'));
        return view('customer_service.warranty.warrantyDetail', compact('warranty', 'employee'));
    }

    public function check_quantity(Request $request)
    {
        $quantity = $this->salesorder_line_service->show_item($request);

        if ($quantity) {
            return json_encode(true);
        }

        return json_encode(false);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $numSO, $modelType)
    {
        $warranty = $this->warranty_service->show($numSO, $modelType);
        $employee = $this->employee_service->get_employee_by_id($request->session()->get('id_employee'));
        return view('customer_service.warranty.editWarranty', compact('warranty', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $numSO, $modelType)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric',
            'information' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/warranty/update/' . $numSO . '/' . $modelType)
                ->withInput()
                ->withErrors($validator);
        }

        $this->warranty_service->update($request, $numSO, $modelType);
        return redirect('/warranty/' . $numSO . '/' . $modelType)->with('success', 'Warranty data with invoice ' . $numSO . ' and model meuble ' . $modelType . ' updated');
    }

    public function update_status($numSO, $modelType)
    {
        $this->warranty_service->update_status($numSO, $modelType);
        return redirect("/warranty")->with('success', 'Warranty status with invoice ' . $numSO . ' and model meuble ' . $modelType . ' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
