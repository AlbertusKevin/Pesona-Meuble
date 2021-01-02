<?php

namespace App\Http\Controllers\Finance;

use App\Domain\Finance\Service\InvoiceSalesOrderService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceSalesOrderController extends Controller
{
    private $invoice_so_service;

    public function __construct()
    {
        $this->invoice_so_service = new InvoiceSalesOrderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = $this->invoice_so_service->index_so_invoice();
        return view('finance.invoice.sales_order.list', compact("invoices"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->invoice_so_service->create_so_invoice($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($num)
    {
        return redirect('/salesorder/history/' . $num);
    }
}
