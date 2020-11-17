<?php

namespace App\Domain\Procurement\Dao;

use App\Domain\Procurement\Entity\PurchaseOrder;

class ProcurementDB
{
    public function showAll()
    {
        return PurchaseOrder::all();
    }

    public function showDetail($num)
    {
        return PurchaseOrder::where('numPO', $num)->first();
    }
}
