<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, December 2020
 */

namespace App\Domain\Procurement\Dao;

use App\Http\Controllers\Controller;
use App\Domain\Procurement\Entity\InvoicePurchase;
use Carbon\Carbon;

class InvoiceProcurementDao extends Controller
{
    public function listInvoice()
    {
        return InvoicePurchase::all();
    }

    public function create($request)
    {
        InvoicePurchase::create([
            'numPO' => $request->numPO,
            'responsibleEmployee' => $request->id,
            'receivedStatus' => 0,
            'date' => Carbon::now()->format("Y-m-d")
        ]);
    }
}
