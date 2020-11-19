<?php

namespace App\Domain\Procurement\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Procurement\Dao\ProcurementDB;
use App\Domain\Employee\Dao\EmployeeDB;
use App\Domain\Procurement\Dao\MeubleDao;
use App\Domain\Vendor\Dao\VendorDB;

class ProcurementService extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */

    private $procurement;
    private $employee;
    private $vendor;
    private $category;

    public function __construct()
    {
        $this->procurement = new ProcurementDB();
        $this->employee = new EmployeeDB();
        $this->vendor = new VendorDB();
        $this->category = new MeubleDao();
    }

    public function show($id)
    {
        $procurement = $this->procurement->showAll();
        $employee = $this->employee->findById($id);
        return view('procurement.listOfProcurement', [
            "procurement" => $procurement,
            "employee" => $employee
        ]);
    }

    public function find($numPO)
    {
        $detailProcurement = $this->procurement->showDetail($numPO);
        return view('procurement.updateviewPurchaseOrder', compact('detailProcurement'));
    }

    public function viewCreate($id)
    {
        $vendor = $this->vendor->showAll();
        $employee = $this->employee->findById($id);
        $category = $this->category->showCategory();
        return view('procurement.createPurchaseOrder', [
            "employee" => $employee,
            "vendor" => $vendor,
            "category" => $category
        ]);
    }

    public function create(Request $request)
    {
        return view('procurement.createPurchaseOrder');
    }

    public function createHeader($id)
    {
        print_r($_POST);
    }
}
