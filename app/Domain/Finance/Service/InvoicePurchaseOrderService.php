<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin December 2020
 */

namespace App\Domain\Finance\Service;

use App\Http\Controllers\Controller;
use App\Domain\Finance\Dao\InvoicePurchaseOrderDao;
use Illuminate\Http\Request;

class InvoicePurchaseOrderService extends Controller
{
    // Deklarasi variable global, untuk pemanggilan model ORM dan class agar bisa digunakan semua function di dalam class ini
    private $invoice;

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model dan class yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function __construct()
    {
        $this->invoice = new InvoicePurchaseOrderDao();
    }

    public function index_po_invoice()
    {
        return $this->invoice->index_po_invoice();
    }

    public function new_po_invoice(Request $request)
    {
        $this->invoice->create($request);
    }
}
