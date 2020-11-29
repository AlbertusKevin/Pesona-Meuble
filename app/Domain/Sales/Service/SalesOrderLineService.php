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
        return redirect()->back()->with('success_so_0', 'Sales Order with number ' . $request->numSO . ' succesfully created!');
    }

    
}
