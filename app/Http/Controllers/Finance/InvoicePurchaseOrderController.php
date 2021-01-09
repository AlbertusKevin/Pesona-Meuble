<?php

namespace App\Http\Controllers\Finance;

use App\Domain\Finance\Service\InvoicePurchaseOrderService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoicePurchaseOrderController extends Controller
{
    private $invoice_po_service;

    public function __construct()
    {
        $this->invoice_po_service = new InvoicePurchaseOrderService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = $this->invoice_po_service->index_po_invoice();
        return view('finance.invoice.procurement.list', compact('invoices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->invoice_po_service->new_po_invoice($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($num)
    {
        return redirect('/procurement/' . $num);
    }

    public function update($num)
    {
        $this->invoice_po_service->update($num);
        return redirect("/procurement/invoice")->with("success", "Goods Request from Invoice " . $num . " is/are received!");
    }
}
