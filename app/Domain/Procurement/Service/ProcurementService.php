<?php

namespace App\Domain\Procurement\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProcurementService extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */

    public function listProcurement()
    {
        return view('procurement.listOfProcurement');
    }

    public function detail_updateProcurement()
    {
        return view('procurement.updateviewPurchaseOrder');
    }

    public function createProcurement()
    {
        return view('procurement.createPurchaseOrder');
    }
}
