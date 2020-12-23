<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, December 2020
 */

namespace App\Domain\Procurement\Dao;

use App\Domain\Procurement\Entity\PurchaseOrder;
use App\Domain\Procurement\Entity\PurchaseOrderLine;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProcurementDB
{
    //ambil semua data PO
    public function showAllOpen()
    {
        return PurchaseOrder::where('transactionStatus', 0)->get();
    }

    public function showAllHistory()
    {
        return PurchaseOrder::where('transactionStatus', "!=", 0)->get();
    }

    //ambil nomor terakhir dari PO yang terakhir kali diinput
    public function getLastNumPO()
    {
        return PurchaseOrder::orderBy('numPO', 'desc')->take(1)->get();
    }

    //ambil detail dari PO berdasarkan nomor PO
    public function showDetailPO($num)
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
            'date' => Carbon::parse($header["date"])->format('Y-m-d'),
            'validTo' =>  Carbon::parse($header["validTo"])->format('Y-m-d'),
            'transactionStatus' => 0,
            'totalItem' => (int)$header["totalItem"],
            'freightIn' => (int)$header["freightIn"],
            'totalPrice' => (int)$header["totalPrice"],
            'totalDiscount' => (int)$header["totalDisc"],
            'totalPayment' => (int)$header["totalPayment"]
        ]);
    }

    public function proceedPO($num)
    {
        PurchaseOrder::where('numPO', $num)->update(['transactionStatus' => 1]);;
    }
    public function cancelPO($num)
    {
        PurchaseOrder::where('numPO', $num)->update(['transactionStatus' => 2]);;
    }

    public function updateHeader($header)
    {
        PurchaseOrder::where('numPO', $header['numPo'])->update([
            'totalItem' => (int)$header["totalItem"],
            'totalPrice' => (int)$header["totalPrice"],
            'totalPayment' => (int)$header["totalPayment"]
            // 'totalDiscount' => (int)$header["totalDisc"],
            // 'freightIn' => (int)$header["freightIn"],
        ]);
    }
}
