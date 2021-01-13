<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin January 2021
 */

namespace App\Domain\CustomerManagement\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\CustomerManagement\Dao\WarrantyDB;
use Illuminate\Support\Facades\Validator;

class WarrantyService extends Controller
{
    // Deklarasi variable global, untuk pemanggilan model ORM dan class agar bisa digunakan semua function di dalam class ini
    private $warranty;

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model dan class yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function __construct()
    {
        $this->warranty = new WarrantyDB();
    }

    public function index()
    {
        return $this->warranty->index();
    }

    public function store($request, $numSO, $id_employee)
    {
        $quantity = $request->quantity;
        $item = $request->item;
        $info = $request->information;

        for ($i = 0; $i < count($quantity); $i++) {
            $data["quantity"] = $quantity[$i];
            $data["item"] = $item[$i];
            $data["info"] = $info[$i];
            $data["employee"] = $id_employee;

            $this->warranty->store($data, $numSO);
        }
    }

    public function show($numSO, $modelType)
    {
        return $this->warranty->show($numSO, $modelType);
    }

    public function get_by_numSO($numSO)
    {
        return $this->warranty->get_by_numSO($numSO);
    }

    public function update_status($numSO, $modelType)
    {
        $this->warranty->update_status($numSO, $modelType);
    }

    public function update($request, $numSO, $modelType)
    {
        $this->warranty->update($request, $numSO, $modelType);
    }
}
