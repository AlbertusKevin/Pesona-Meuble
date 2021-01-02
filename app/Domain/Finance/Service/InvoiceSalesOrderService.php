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
        $this->invoice->create($request);
    }
}
