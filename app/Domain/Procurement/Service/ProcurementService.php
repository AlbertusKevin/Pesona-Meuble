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
        $numPO = $this->procurement->getLastNumPO();
        if (count($numPO) != 0) {
            $numPO = $numPO[0]->numPO;
            $numPO = ((int)$numPO) + 1;
            $numPO = (string)$numPO;
        } else {
            $numPO = "10000001";
        }

        return view('procurement.createPurchaseOrder', [
            "employee" => $employee,
            "vendor" => $vendor,
            "category" => $meuble,
            "num" => $numPO
        ]);
    }

    public function createHeader($id)
    {
        // numPo, vendor, employeeName, date, validTo, totalItem, freightIn, totalPrice, totalDisc, totalPayment
        $this->procurement->insertHeader($_POST);
    }

    public function create($id)
    {
        $available = $this->meuble->findMeubleByModelType($_POST['modelType']);
        if (isset($available)) {
            $stock = $this->meuble->findMeubleByModelType($_POST['modelType']);
            $stock = $stock->stock;
            $stock += $_POST['quantity'];
            $this->meuble->update($_POST, $stock);
        } else {
            $this->meuble->insert($_POST);
        }
        $this->procurement->insertHeaderLine($_POST);
        echo "success";
    }

    public function generateMeubleForProcurement()
    {
        $meuble = $this->meuble->findMeubleByModelType($_POST['model']);
        if (isset($meuble)) {
            return $meuble;
        }

        return false;
    }
}
