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
    //ambil data line PO berdasarkan nomor PO
    public function showDetailPOLine($num)
    {
        return PurchaseOrderLine::where('numPO', $num)
            ->join('meuble', 'purchase_order_line.modelType', '=', 'meuble.modelType')->get();
    }

    //input data line item ke purchase_order_line setelah data PO berhasil diinput
    public function insertHeaderLine($line)
    {
        PurchaseOrderLine::create([
            'numPO' => $line["numPo"],
            'modelType' => $line["modelType"],
            'price' => $line["price"],
            'quantity' => $line["quantity"]
        ]);
    }

    public function deleteLine($header)
    {
        PurchaseOrderLine::where('numPO', $header['numPo'])->delete();
    }
}
