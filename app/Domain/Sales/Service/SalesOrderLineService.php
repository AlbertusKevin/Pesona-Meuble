<?php

namespace App\Domain\Sales\Service;

use App\Http\Controllers\Controller;
use App\Domain\Sales\Entity\SalesOrderLine;
use App\Domain\Sales\Dao\SalesOrderLineDB;
use Illuminate\Http\Request;

class SalesOrderLineService extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */

    private $salesorderlines;

    public function __construct()
    {
        $this->salesorderlines = new SalesOrderLineDB();
    }

    public function createSalesOrderLine(Request $request)
    {
        $this->salesorderlines->insertHeaderLine($request);
    }

    public function updateSalesOrderLine(Request $request)
    {
        // numPo, vendor, employeeName, date, validTo, totalItem, freightIn, totalPrice, totalDisc, totalPayment
        $this->salesorderlines->updateSalesOrderLine($request);
    }

    public function addNewLineItem($num)
    {
        $this->salesorderlines->addNewLineItem($num, $_POST);
    }

    public function deleteNewLineItem($num, $model)
    {
        $this->salesorderlines->deleteNewLineItem($num, $model);
    }
}
