<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 * Code's Refactor by Albertus Kevin, Januari 2021
 */

namespace App\Domain\Sales\Dao;

use App\Http\Controllers\Controller;
use App\Domain\Sales\Entity\SalesOrder;
use Carbon\Carbon;

class SalesOrderDao
{
    public function index()
    {
        return SalesOrder::where('transactionStatus', 0)->get();
    }

    public function index_history()
    {
        return  Salesorder::where('transactionStatus', '!=', 0)->get();
    }

    public function get_by_customer_and_numSO($numSO)
    {
        return SalesOrder::where('numSO', $numSO)
            ->join('customer', 'sales_order.customer', '=', 'customer.id')
            ->first();
    }

    public function get_last_numSO()
    {
        return Salesorder::orderBy('numSO', 'desc')->take(1)->get();
    }

    public function store_header($header)
    {

        SalesOrder::create([
            'numSO' => $header->numSO,
            'customer' => (int)$header->customer,
            'responsibleEmployee' => (int)$header->id,
            'date' => Carbon::parse($header->date)->format('Y-m-d'),
            'validTo' => Carbon::parse($header->validTo)->format('Y-m-d'),
            'transactionStatus' => 0,
            'totalItem' => (int)$header->totalItem,
            'freightIn' => (int)$header->freightIn,
            'totalPrice' => (int)$header->totalPrice,
            'totalDiscount' => (int)$header->totalDisc,
            'totalPayment' => (int)$header->totalPayment
        ]);
    }

    public function update_header($header)
    {
        SalesOrder::where('numSO', $header->numSO)->update([
            'totalItem' => (int)$header->totalItem,
            'totalPrice' => (int)$header->totalPrice,
            'totalDiscount' => (int)$header->totalDisc,
            'totalPayment' => (int)$header->totalPayment
        ]);
    }

    public function proceed($numSO)
    {
        SalesOrder::where('numSO', $numSO)->update(['transactionStatus' => 1]);;
    }
    public function cancel($numSO)
    {
        SalesOrder::where('numSO', $numSO)->update(['transactionStatus' => 2]);;
    }
}
