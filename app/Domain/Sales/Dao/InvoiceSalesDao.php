<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, December 2020
 */

namespace App\Domain\Sales\Dao;

use App\Http\Controllers\Controller;
use App\Domain\Sales\Entity\InvoiceSales;
use Carbon\Carbon;

class InvoiceSalesDao extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */

    public function listInvoice()
    {
        return InvoiceSales::all();
    }

    public function create($request)
    {
        InvoiceSales::create([
            'numSO' => $request->numSO,
            'responsibleEmployee' => $request->id,
            'date' => Carbon::now()->format("Y-m-d")
        ]);
    }
}
