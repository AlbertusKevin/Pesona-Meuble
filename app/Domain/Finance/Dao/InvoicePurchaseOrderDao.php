<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, December 2020
 */

namespace App\Domain\Finance\Dao;

use App\Http\Controllers\Controller;
use App\Domain\Finance\Entity\InvoicePurchase;
use Carbon\Carbon;

class InvoicePurchaseOrderDao extends Controller
{
    public function index_po_invoice()
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

    public function update($num)
    {
        InvoicePurchase::where('numPO', $num)->update([
            'receivedStatus' => 1
        ]);
    }
}
