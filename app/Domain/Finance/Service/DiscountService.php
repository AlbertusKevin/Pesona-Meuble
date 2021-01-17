<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Chris Christian, December 2020
 */

namespace App\Domain\Finance\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Finance\Dao\DiscountDB;
use App\Domain\Employee\Service\EmployeeService;
use Illuminate\Support\Facades\Validator;

class DiscountService extends Controller
{
    // Deklarasi variable global, untuk pemanggilan model ORM dan class agar bisa digunakan semua function di dalam class ini
    private $discounts;

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model dan class yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function __construct()
    {
        $this->discounts = new DiscountDB();
    }

    public function index_discount()
    {
        return $this->discounts->index();
    }

    public function discount_by_code($code)
    {
        return $this->discounts->discount_by_code($code);
    }

    public function new_discount(Request $request)
    {
        $this->discounts->new_discount($request);
    }

    public function update_status($code)
    {
        $this->discounts->update_status($code);
    }

    public function update_data($request, $code)
    {
        $this->discounts->update_data($request, $code);
    }

    public function delete_discount($code)
    {
        $this->discounts->delete_discount($code);
    }

    public function discounts()
    {
        return $this->discounts->index();
    }
}
