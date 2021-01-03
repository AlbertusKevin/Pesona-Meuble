<?php

namespace App\Http\Controllers\Warehouse;

use App\Domain\Warehouse\Service\DeliveryService;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    private $delivery_service;

    public function __construct()
    {
        $this->delivery_service = new DeliveryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliveries = $this->delivery_service->index();
        return view('sales.shipment.shipmentlist', compact('deliveries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($num)
    {
        return view('sales.shipment.createShipment', compact('num'));
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
            'numSO' => 'required',
            'shippingPoint' => 'required',
            'status' => 'required',
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
        return view('sales.shipment.shipmentDetail', compact('delivery'));
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
