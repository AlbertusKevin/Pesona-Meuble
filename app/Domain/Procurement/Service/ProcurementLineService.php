<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, December 2020
 */

namespace App\Domain\Procurement\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Procurement\Dao\ProcurementLineDB;
use App\Domain\Procurement\Service\ProcurementService;

class ProcurementLineService extends Controller
{
    // Deklarasi variable global, untuk pemanggilan model ORM dan class agar bisa digunakan semua function di dalam class ini
    private $procurementline;

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model dan class yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function __construct()
    {
        $this->procurementline = new ProcurementLineDB();
    }

    //==================================================================================================================================================
    // Ambil data Pembelian Barang
    //==================================================================================================================================================
    //menampilkan detail line item dari salah satu procurement
    public function insertLine(Request $request)
    {
        $this->procurementline->insertHeaderLine($request);
    }

    public function deleteLine(Request $request)
    {
        // numPo, vendor, employeeName, date, validTo, totalItem, freightIn, totalPrice, totalDisc, totalPayment
        $this->procurementline->deleteLine($request);
    }

    //===============================================================================================================================================================================================================
    // Fungsi khusus untuk digunakan class lain
    //===============================================================================================================================================================================================================
    public function detailLine($numPO)
    {
        return $this->procurementline->showDetailPOLine($numPO);
    }
}
