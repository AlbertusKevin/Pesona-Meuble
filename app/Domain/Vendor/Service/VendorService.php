<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, Mikhael Adriel, December 2020
 */

namespace App\Domain\Vendor\Service;

use App\Http\Controllers\Controller;
use App\Domain\Vendor\Dao\VendorDB;

class VendorService extends Controller
{
    // Deklarasi variable global, untuk pemanggilan model ORM dan class agar bisa digunakan semua function di dalam class ini
    private $vendors;

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model dan class yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function __construct()
    {
        $this->vendors = new VendorDB();
    }

    public function index()
    {
        return $this->vendors->index();
    }

    public function vendor_by_code($companyCode)
    {
        return $this->vendors->vendor_by_code($companyCode);
    }

    public function new_vendor($request)
    {
        $this->vendors->new_vendor($request);
    }

    public function update_vendor($request, $companyCode)
    {
        $this->vendors->update_vendor($request, $companyCode);
    }
}
