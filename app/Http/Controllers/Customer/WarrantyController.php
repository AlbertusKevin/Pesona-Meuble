<?php

namespace App\Http\Controllers\Customer;

use App\Domain\CustomerManagement\Service\WarrantyService;
use App\Domain\Sales\Service\SalesOrderLineService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WarrantyController extends Controller
{
    private $warranty_service;
    private $salesorder_line_service;

    public function __construct()
    {
        $this->warranty_service = new WarrantyService;
        $this->salesorder_line_service = new SalesOrderLineService;
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

        $items = $this->salesorder_line_service->show_line($request->number);
        if (count($items) == 0) {
            return redirect('/warranty')->with('error', "There's no invoice with that number. Please recheck your input!");
        }

        return view('customer_service.warranty.newWarranty', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->quantity);
        dd($request->item);
        dd($request->description);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
