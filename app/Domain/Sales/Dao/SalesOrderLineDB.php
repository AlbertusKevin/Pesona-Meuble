<?php

namespace App\Domain\Sales\Dao;

use App\Http\Controllers\Controller;
use App\Domain\Sales\Entity\SalesOrderLine;
use Illuminate\Http\Request;


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
            'quantity' => $line["quantity"]
        ]);
    }
    
}
