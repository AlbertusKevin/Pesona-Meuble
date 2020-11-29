<?php

namespace App\Domain\Procurement\Dao;

use App\Domain\Procurement\Entity\PurchaseOrder;
use App\Domain\Procurement\Entity\PurchaseOrderLine;

class ProcurementDB
{
    //ambil semua data PO
    public function showAll()
    {
        return PurchaseOrder::all();
    }

    //ambil nomor terakhir dari PO yang terakhir kali diinput
    public function getLastNumPO()
    {
        return PurchaseOrder::orderBy('numPO', 'desc')->take(1)->get();
    }

    //ambil detail dari PO berdasarkan nomor PO
    public function showDetail($num)
    {
        return PurchaseOrder::where('numPO', $num)->first();
    }

    //insert data header dari PO ke tabel purchase_order
    public function insertHeader($header)
    {
        PurchaseOrder::create([
            'numPO' => $header["numPo"],
            'vendor' => $header["vendor"],
            'responsibleEmployee' => (int)$header["id"],
            'date' => date("Y M D", strtotime($header["date"])),
            'validTo' => date("Y M D", strtotime($header["validTo"])),
            'transactionStatus' => 0,
            'totalItem' => (int)$header["totalItem"],
            'freightIn' => (int)$header["freightIn"],
            'totalPrice' => (int)$header["totalPrice"],
            'totalDiscount' => (int)$header["totalDisc"],
            'totalPayment' => (int)$header["totalPayment"]
        ]);
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
}
