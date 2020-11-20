<?php

namespace App\Domain\Procurement\Dao;

use App\Domain\Procurement\Entity\PurchaseOrder;
use App\Domain\Procurement\Entity\PurchaseOrderLine;

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

    public function insertHeader($header)
    {
        // try{

        // }catch{
        //     return false;
        // }
        PurchaseOrder::create([
            'numPO' => $header["numPo"],
            'vendor' => $header["vendor"],
            'responsibleEmployee' => (int)$header["employeeName"],
            // 'date' => date("Y M D", $header["date"]),
            // 'validTo' => date("Y M D", $header["validTo"]),
            'transactionStatus' => 0,
            'totalItem' => (int)$header["totalItem"],
            'freightIn' => (int)$header["freightIn"],
            'totalPrice' => (int)$header["totalPrice"],
            'totalDiscount' => (int)$header["totalDisc"],
            'totalPayment' => (int)$header["totalPayment"]
        ]);
        return true;
    }

    public function insertHeaderLine($line)
    {
        // try{

        // }catch{
        //     return false;
        // }
        PurchaseOrderLine::create([
            'numPO' => $line["numPo"],
            'modelType' => $line["modelType"],
            'price' => $line["price"],
            'quantity' => $line["quantity"]
        ]);
        return true;
    }
}
