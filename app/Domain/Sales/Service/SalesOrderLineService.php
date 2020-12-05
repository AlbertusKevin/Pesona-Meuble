<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 */

namespace App\Domain\Sales\Service;

use App\Http\Controllers\Controller;
use App\Domain\Sales\Entity\SalesOrderLine;
use App\Domain\Sales\Dao\SalesOrderLineDB;
use Illuminate\Http\Request;

class SalesOrderLineService extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */

    private $salesorderlines; 

    public function __construct()
    {
        $this->salesorderlines = new SalesOrderLineDB();

    }

    public function createSalesOrderLine(Request $request)
    {
        $this->salesorderlines->insertHeaderLine($request);
    }

    public function updateSalesOrderLine(Request $request)
    {
        // numPo, vendor, employeeName, date, validTo, totalItem, freightIn, totalPrice, totalDisc, totalPayment
        $this->salesorderlines->updateSalesOrderLine($request);
    }

    
}
