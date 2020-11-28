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
    // Deklarasi kelas global, untuk pemanggilan model ORM
    private $procurement;
    private $employee;
    private $vendor;
    private $meuble;

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function __construct()
    {
        $this->procurement = new ProcurementDB();
        $this->employee = new EmployeeDB();
        $this->vendor = new VendorDB();
        $this->meuble = new MeubleDao();
    }

    //==================================================================================================================================================
    // Ambil data Pembelian Barang
    //==================================================================================================================================================
    // menampilkan semua procurement bagian header
    public function show($id)
    {
        $procurement = $this->procurement->showAll();
        $employee = $this->employee->findById($id);
        return view('procurement.listOfProcurement', [
            "procurement" => $procurement,
            "employee" => $employee
        ]);
    }

    //menampilkan detail line item dari salah satu procurement
    public function detail($id, $numPO)
    {
        $detailProcurement = $this->procurement->showDetail($numPO);
        $employee = $this->employee->findById($id);
        return view('procurement.updateviewPurchaseOrder', ["po" => $detailProcurement, "employee" => $employee]);
    }

    //==================================================================================================================================================
    // Insert data Pembelian Barang
    //==================================================================================================================================================
    //mengambil view create pembelian barang
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

    // Insert Header dari PO
    public function createHeader($id)
    {
        // numPo, vendor, employeeName, date, validTo, totalItem, freightIn, totalPrice, totalDisc, totalPayment
        $this->procurement->insertHeader($_POST);
    }

    // Insert Line Item PO
    public function create(Request $request, $id)
    {
        // $available = $this->meuble->findMeubleByModelType($_POST['modelType']);
        // if (isset($available)) {
        //     $stock = $this->meuble->findMeubleByModelType($_POST['modelType']);
        //     $stock = $stock->stock;
        //     $stock += $_POST['quantity'];
        //     $this->meuble->update($_POST, $stock);
        // }

        $this->procurement->insertHeaderLine($request, $id);
        return redirect()->back()->with('success_po_0', 'Purchase Order with number ' . $request->numPo . ' succesfully created!');
    }
}
