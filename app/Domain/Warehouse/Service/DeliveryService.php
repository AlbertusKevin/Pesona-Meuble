<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 */

namespace App\Domain\Warehouse\Service;

use App\Http\Controllers\Controller;
use App\Domain\Warehouse\Dao\DeliveryDao;
use Illuminate\Http\Request;

class DeliveryService extends Controller
{
    // Deklarasi variable global, untuk pemanggilan model ORM dan class agar bisa digunakan semua function di dalam class ini
    private $delivery;

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model dan class yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function __construct()
    {
        $this->delivery = new DeliveryDao();
    }

    public function index()
    {
        return $this->delivery->index();
    }

    public function show($num)
    {
        return $this->delivery->show($num);
    }

    public function store($num, $request)
    {
        $this->delivery->store($num, $request);
    }

    public function change($num)
    {
        $this->delivery->updateStatus($num);
        return redirect('/delivery')->with('delivery', 'Shipment Number ' . $num . ' Processed');
    }
}
