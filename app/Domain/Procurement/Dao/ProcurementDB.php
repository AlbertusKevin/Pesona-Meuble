<?php

namespace App\Domain\Procurement\Dao;

use App\Domain\Procurement\Entity\PurchaseOrder;
use App\Domain\Procurement\Entity\PurchaseOrderLine;
use Carbon\Carbon;

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
    //ambil data line PO berdasarkan nomor PO
    public function showDetailPOLine($num)
    {
        return PurchaseOrderLine::where('numPO', $num)
            ->join('meuble', 'purchase_order_line.modelType', '=', 'meuble.modelType')->get();
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
    public function addNewLineItem($num, $line)
    {
        PurchaseOrderLine::create([
            'numPO' => $num,
            'modelType' => $line["model"],
            'price' => $line["price"],
            'quantity' => $line["quantity"]
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

    public function updateHeaderLine($header)
    {
        PurchaseOrder::where('numPO', $header['numPo'])->update([
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

    public function updateLine($line)
    {
        PurchaseOrderLine::where('numPO', $line["numPo"])->where('modelType', $line["modelType"])->update([
            'quantity' => $line["quantity"]
        ]);
    }
}
