<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 */

namespace App\Domain\Sales\Service;

use App\Http\Controllers\Controller;
use App\Domain\Sales\Dao\SalesOrderLineDB;
use Illuminate\Http\Request;

class SalesOrderLineService extends Controller
{
    private $salesorderlines;

    public function __construct()
    {
        $this->salesorderlines = new SalesOrderLineDB();
    }

    public function store_line(Request $request)
    {
        $this->salesorderlines->store_line($request);
    }

    public function delete_line(Request $request)
    {
        $this->salesorderlines->delete_line($request);
    }

    public function show_line($numSO)
    {
        return $this->salesorderlines->show_line($numSO);
    }
}
