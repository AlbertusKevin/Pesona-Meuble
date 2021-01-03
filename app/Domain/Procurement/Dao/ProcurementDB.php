<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, December 2020
 */

namespace App\Domain\Procurement\Dao;

use App\Domain\Procurement\Entity\PurchaseOrder;
use Carbon\Carbon;

class ProcurementDB
{
    public function index_open()
    {
        return PurchaseOrder::where('transactionStatus', 0)->get();
    }

    public function index_history()
    {
        return PurchaseOrder::where('transactionStatus', "!=", 0)->get();
    }

    public function get_last_numPO()
    {
        return PurchaseOrder::orderBy('numPO', 'desc')->take(1)->get();
    }

    public function show_header($num)
    {
        return PurchaseOrder::where('numPO', $num)->first();
    }

    public function store($header)
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

    public function proceed($num)
    {
        PurchaseOrder::where('numPO', $num)->update(['transactionStatus' => 1]);;
    }
    public function cancel($num)
    {
        PurchaseOrder::where('numPO', $num)->update(['transactionStatus' => 2]);;
    }

    public function update($header)
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
