<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, December 2020
 */

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
    public function showOpen()
    {
        $procurement = $this->procurement->showAllOpen();
        return view('procurement.listOfProcurement', [
            "procurement" => $procurement
        ]);
    }

    public function showHistory()
    {
        $procurement = $this->procurement->showAllHistory();
        return view('procurement.historyOfProcurement', [
            "procurement" => $procurement
        ]);
    }

    //menampilkan detail line item dari salah satu procurement
    public function detail(Request $request, $numPO)
    {
        $detailProcurement = $this->procurement->showDetailPO($numPO);
        $detailProcurementLine = $this->procurement->showDetailPOLine($numPO);
        $employee = $this->employee->findById($request->session()->get('id_employee'));
        return view('procurement.updateviewPurchaseOrder', [
            "po" => $detailProcurement,
            "line" => $detailProcurementLine,
            "employee" => $employee
        ]);
    }
    //menampilkan detail line item dari salah satu procurement
    public function detailHistory(Request $request, $numPO)
    {
        $detailProcurement = $this->procurement->showDetailPO($numPO);
        $detailProcurementLine = $this->procurement->showDetailPOLine($numPO);
        $employee = $this->employee->findById($request->session()->get('id_employee'));
        return view('procurement.detailPurchaseOrder', [
            "po" => $detailProcurement,
            "line" => $detailProcurementLine,
            "employee" => $employee
        ]);
    }

    //==================================================================================================================================================
    // Insert data Pembelian Barang
    //==================================================================================================================================================
    //mengambil view create pembelian barang
    public function viewCreate(Request $request)
    {
        $vendor = $this->vendor->showAll();
        $employee = $this->employee->findById($request->session()->get('id_employee'));
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
    public function createHeader(Request $request)
    {
        // numPo, vendor, employeeName, date, validTo, totalItem, freightIn, totalPrice, totalDisc, totalPayment
        $this->procurement->insertHeader($request);
    }

    // Insert Line Item PO
    public function create(Request $request)
    {
        $this->procurement->insertHeaderLine($request);
    }
    public function proceedPO($num)
    {
        // numPo, vendor, employeeName, date, validTo, totalItem, freightIn, totalPrice, totalDisc, totalPayment
        $this->procurement->proceedPO($num);
        $this->redirect('/procurement/menu');
    }
    public function cancelPO($num)
    {
        // numPo, vendor, employeeName, date, validTo, totalItem, freightIn, totalPrice, totalDisc, totalPayment
        $this->procurement->cancelPO($num);
        return redirect('/procurement/list')->with('cancel_po', 'Purchase Order ' . $num . ' canceled!');
    }

    public function updateHeader(Request $request)
    {
        // numPo, vendor, employeeName, date, validTo, totalItem, freightIn, totalPrice, totalDisc, totalPayment
        $this->procurement->updateHeader($request);
    }
    public function updateLine(Request $request)
    {
        // numPo, vendor, employeeName, date, validTo, totalItem, freightIn, totalPrice, totalDisc, totalPayment
        $this->procurement->updateLine($request);
    }

    public function addNewLineItem($num)
    {
        $this->procurement->addNewLineItem($num, $_POST);
    }

    public function deleteNewLineItem($num, $model)
    {
        $this->procurement->deleteNewLineItem($num, $model);
    }
    // $available = $this->meuble->findMeubleByModelType($_POST['modelType']);
    // if (isset($available)) {
    //     $stock = $this->meuble->findMeubleByModelType($_POST['modelType']);
    //     $stock = $stock->stock;
    //     $stock += $_POST['quantity'];
    //     $this->meuble->update($_POST, $stock);
    // }
}
