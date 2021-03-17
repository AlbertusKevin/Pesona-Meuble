<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Chris Christian, Mikhael Adriel, December 2020
 */

namespace App\Domain\CustomerManagement\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\CustomerManagement\Dao\CustomerDB;
use App\Domain\Employee\Dao\EmployeeDB;
use Illuminate\Support\Facades\Validator;

class CustomerService extends Controller
{
    // Deklarasi variable global, untuk pemanggilan model ORM dan class agar bisa digunakan semua function di dalam class ini
    private $customers;
    private $employee;

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model dan class yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function __construct()
    {
        $this->customers = new CustomerDB();
    }

    public function index_customers()
    {
        return $this->customers->index_customers();
    }

    public function new_customer($request)
    {
        return $this->customers->create_customer($request);
    }

    public function update($request, $id)
    {
        $this->customers->update_customer($request, $id);
    }

    //===============================================================================================================================================================================================================
    // Fungsi khusus untuk digunakan class lain
    //===============================================================================================================================================================================================================
    public function customer_by_id($id)
    {
        return $this->customers->customer_by_id($id);
    }
}
