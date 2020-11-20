<?php

namespace App\Domain\Procurement\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Procurement\Dao\ProcurementDB;
use App\Domain\Employee\Dao\EmployeeDB;
use App\Domain\Procurement\Dao\MeubleDao;
use App\Domain\Vendor\Dao\VendorDB;

use function PHPSTORM_META\type;

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
    private $meuble;

    public function __construct()
    {
        $this->procurement = new ProcurementDB();
        $this->employee = new EmployeeDB();
        $this->vendor = new VendorDB();
        $this->meuble = new MeubleDao();
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
        $meuble = $this->meuble->showCategory();
        return view('procurement.createPurchaseOrder', [
            "employee" => $employee,
            "vendor" => $vendor,
            "category" => $meuble
        ]);
    }

    public function createHeader($id)
    {
        // numPo, vendor, employeeName, date, validTo, totalItem, freightIn, totalPrice, totalDisc, totalPayment
        $this->procurement->insertHeader($_POST);
    }

    public function create($id)
    {
        $this->meuble->insert($_POST);
        $this->procurement->insertHeaderLine($_POST);
        echo "we're in";
    }
}
