<?php

namespace App\Http\Controllers\Warehouse;

use App\Domain\Finance\Service\InvoiceSalesOrderService;
use App\Domain\Sales\Service\SalesOrderService;
use App\Domain\Warehouse\Service\DeliveryService;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    private $delivery_service;
    private $invoice_so_service;

    public function __construct()
    {
        $this->delivery_service = new DeliveryService;
        $this->invoice_so_service = new InvoiceSalesOrderService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliveries = $this->delivery_service->index();
        return view('warehouse.shipment.shipmentlist', compact('deliveries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($num)
    {
        return view('warehouse.shipment.createShipment', compact('num'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($num, Request $request)
    {
        $request->validate([
            'shippingPoint' => 'required',
            'shipDate' => 'required',
            'deliveredDate' => 'required',
            'notes' => 'required'
        ]);

        $this->delivery_service->store($num, $request);
        return redirect('/delivery');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($num)
    {
        $delivery = $this->delivery_service->show($num);
        return view('warehouse.shipment.shipmentDetail', compact('delivery'));
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
    public function update($num)
    {
        $this->delivery_service->change($num);
        return redirect('/delivery')->with('success', 'Shipment Number ' . $num . ' Processed');
    }

    public function update_complete_status($numSO)
    {
        $this->invoice_so_service->update_complete_status($numSO);
        return redirect("/salesorder/invoice")->with("success", 'Invoice Sales Order ' . $numSO . ' is Complete!');
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
