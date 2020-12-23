<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin December 2020
 */

namespace App\Domain\Procurement\Service;

use App\Http\Controllers\Controller;
use App\Domain\Procurement\Dao\InvoiceProcurementDao;
use Illuminate\Http\Request;

class InvoiceProcurementService extends Controller
{
    // Deklarasi variable global, untuk pemanggilan model ORM dan class agar bisa digunakan semua function di dalam class ini
    private $invoice;

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model dan class yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function __construct()
    {
        $this->invoice = new InvoiceProcurementDao();
    }

    public function listInvoicePO()
    {
        $invoices = $this->invoice->listInvoice();
        return view('finance.invoice.procurement.list', compact('invoices'));
    }

    public function detailInvoicePO($num)
    {
        return redirect('/procurement/history/detail/' . $num);
    }

    public function createInvoicePO(Request $request)
    {
        $this->invoice->create($request);
    }
}
