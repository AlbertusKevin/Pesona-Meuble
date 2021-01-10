<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, December 2020
 */

namespace App\Domain\Finance\Dao;

use App\Http\Controllers\Controller;
use App\Domain\Finance\Entity\InvoiceSales;
use Carbon\Carbon;

class InvoiceSalesOrderDao extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */

    public function index_so_invoice()
    {
        return InvoiceSales::all();
    }

    public function create($request, $isComplete, $isSent)
    {
        InvoiceSales::create([
            'numSO' => $request->numSO,
            'responsibleEmployee' => $request->id,
            'date' => Carbon::now()->format("Y-m-d"),
            'isSent' => $isSent,
            'isComplete' => $isComplete
        ]);
    }

    public function update_complete_status($numSO)
    {
        InvoiceSales::where('numSO', $numSO)->update([
            'isComplete' => 1
        ]);
    }
    public function update_sent_status($numSO)
    {
        InvoiceSales::where('numSO', $numSO)->update([
            'isComplete' => 1
        ]);
    }
}
