<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, December 2020
 */

namespace App\Domain\Procurement\Dao;

use App\Domain\Procurement\Entity\PurchaseOrderLine;

class ProcurementLineDB
{
    public function show_line($num)
    {
        return PurchaseOrderLine::where('numPO', $num)
            ->join('meuble', 'purchase_order_line.modelType', '=', 'meuble.modelType')->get();
    }

    public function store_line($line)
    {
        PurchaseOrderLine::create([
            'numPO' => $line->numPo,
            'modelType' => $line->modelType,
            'buying_price' => $line->price,
            'quantity' => $line->quantity
        ]);
    }

    public function delete_line($header)
    {
        PurchaseOrderLine::where('numPO', $header['numPo'])->delete();
    }
}
