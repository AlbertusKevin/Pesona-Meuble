<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Chris Christian, December 2020
 */

namespace App\Domain\Sales\Dao;

use App\Http\Controllers\Controller;
use App\Domain\Sales\Entity\SalesOrder;
use Carbon\Carbon;

class SalesOrderDao extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */

    public function findAllSalesOrders()
    {
        // $salesorders = SalesOrder::orderBy('numSO', 'asc')->paginate(9);
        return SalesOrder::where('transactionStatus', 0)->get();
    }

    public function findSalesOrderByNumSOWithCustomer($numSO)
    {
        $salesorder = SalesOrder::where('numSO', $numSO)
            ->join('customer', 'sales_order.customer', '=', 'customer.id')
            ->first();
        return $salesorder;
    }

    public function findLastNumSO()
    {
        $salesorder =  Salesorder::orderBy('numSO', 'desc')->take(1)->get();
        return $salesorder;
    }

    public function findSalesOrderHistory()
    {
        $salesorders =  Salesorder::where('transactionStatus', '=', 1)
            ->orwhere('transactionStatus', '=', 2)
            ->orwhere('transactionStatus', '=', 3)
            ->get();
        return $salesorders;
    }

    //insert data header dari PO ke tabel purchase_order
    public function createSalesOrder($header)
    {

        SalesOrder::create([
            'numSO' => $header["numSO"],
            'customer' => (int)$header["customer"],
            'responsibleEmployee' => (int)$header["id"],
            'date' => Carbon::parse($header["date"])->format('Y-m-d'),
            'validTo' => Carbon::parse($header["validTo"])->format('Y-m-d'),
            'transactionStatus' => 0,
            'totalItem' => (int)$header["totalItem"],
            'freightIn' => (int)$header["freightIn"],
            'totalPrice' => (int)$header["totalPrice"],
            'paymentDiscount' => "default_p",
            // 'totalDiscount' => (int)$header["totalDisc"],
            'totalDiscount' => 0,
            'totalPayment' => (int)$header["totalPayment"]
        ]);
    }

    public function updateSalesOrder($header)
    {

        SalesOrder::where('numSO', $header['numSO'])->update([
            'totalItem' => (int)$header["totalItem"],
            'totalPrice' => (int)$header["totalPrice"],
            // 'totalDiscount' => (int)$header["totalDisc"],
            'totalDiscount' => 0,
            'totalPayment' => (int)$header["totalPayment"]
        ]);
    }

    public function updateProceed($numSO)
    {
        SalesOrder::where('numSO', $numSO)->update(['transactionStatus' => 1]);;
    }
    public function cancelSO($numSO)
    {
        SalesOrder::where('numSO', $numSO)->update(['transactionStatus' => 2]);;
    }

    public function updateFinish($numSO)
    {
        SalesOrder::where('numSO', $numSO)->update(['transactionStatus' => 3]);;
    }
}
