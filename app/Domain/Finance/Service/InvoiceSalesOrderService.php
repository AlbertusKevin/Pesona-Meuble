<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 */

namespace App\Domain\Finance\Service;

use App\Http\Controllers\Controller;
use App\Domain\Finance\Dao\InvoiceSalesOrderDao;
use Illuminate\Http\Request;

class InvoiceSalesOrderService extends Controller
{
    // Deklarasi variable global, untuk pemanggilan model ORM dan class agar bisa digunakan semua function di dalam class ini
    private $invoice;

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model dan class yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function __construct()
    {
        $this->invoice = new InvoiceSalesOrderDao();
    }

    public function index_so_invoice()
    {
        return $this->invoice->index_so_invoice();
    }

    public function create_so_invoice(Request $request)
    {
        if ($request->freightIn == 0) {
            $isComplete = 1;
            $isSent = 0;
        } else {
            $isComplete = 0;
            $isSent = 1;
        }
        $this->invoice->create($request, $isComplete, $isSent);
    }

    public function update_complete_status($numSO)
    {
        $this->invoice->update_complete_status($numSO);
    }

    public function update_sent_status($numSO)
    {
        $this->invoice->update_complete_status($numSO);
    }
}
