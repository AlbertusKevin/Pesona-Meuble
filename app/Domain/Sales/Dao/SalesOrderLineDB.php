<?php

namespace App\Domain\Sales\Dao;

use App\Http\Controllers\Controller;
use App\Domain\Sales\Entity\SalesOrderLine;

class SalesOrderLineDB extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */

    public function insertHeaderLine($line)
    {
        SalesOrderLine::create([
            'numSO' => $line["numSO"],
            'modelType' => $line["modelType"],
            'price' => $line["price"],
            'discountMeuble' => $line["discountMeuble"],
            'quantity' => $line["quantity"]
        ]);
    }

    public function findSalesOrderLineByNumSO($numSO)
    {
        $salesorderline = SalesOrderLine::where('numSO', $numSO)->get();
        return $salesorderline;
    }

    public function findSalesOrderLineDetail($numSO)
    {
        return SalesOrderLine::where('numSO', $numSO)
            ->join('meuble', 'sales_order_line.modelType', '=', 'meuble.modelType')->get();
    }

    public function updateSalesOrderLine($line)
    {
        SalesOrderLine::where('numSO', $line["numSO"])->where('modelType', $line["modelType"])->update([
            'quantity' => $line["quantity"]
        ]);
    }

    public function updateLine($line)
    {
        SalesOrderLine::where('numSO', $line["numSO"])->where('modelType', $line["modelType"])->update([
            'quantity' => $line["quantity"]
        ]);
    }

    public function addNewLineItem($num, $line)
    {
        SalesOrderLine::create([
            'numSO' => $num,
            'modelType' => $line["model"],
            'price' => $line["price"],
            'quantity' => $line["quantity"],
            'discountMeuble' => $line["discMeuble"]
        ]);
    }
    public function deleteNewLineItem($num, $model)
    {
        SalesOrderLine::where('numSO', $num)->where('modelType', $model)->delete();
    }
}
