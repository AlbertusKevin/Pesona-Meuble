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
use App\Domain\Procurement\Service\ProcurementLineService;
use App\Domain\Employee\Service\EmployeeService;
use App\Domain\Procurement\Service\MeubleService;
use App\Domain\Vendor\Service\VendorService;

class ProcurementService extends Controller
{
    // Deklarasi variable global, untuk pemanggilan model ORM dan class agar bisa digunakan semua function di dalam class ini
    private $procurement;
    private $employee;
    private $vendor;
    private $meuble;
    private $procurementline;

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model dan class yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function __construct()
    {
        $this->procurement = new ProcurementDB();
        $this->procurementline = new ProcurementLineService();
        $this->employee = new EmployeeService();
        $this->vendor = new VendorService();
        $this->meuble = new MeubleService();
    }

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
        $detailProcurement = $this->showDetail($numPO);
        $detailProcurementLine = $this->procurementline->detailLine($numPO);
        $employee = $this->employee->getResponsibleEmployee($request);
        return view('procurement.updateviewPurchaseOrder', [
            "po" => $detailProcurement,
            "line" => $detailProcurementLine,
            "employee" => $employee
        ]);
    }
    //menampilkan detail line item dari salah satu procurement
    public function detailHistory(Request $request, $numPO)
    {
        $detailProcurement = $this->showDetail($numPO);
        $detailProcurementLine = $this->procurementline->detailLine($numPO);
        $employee = $this->employee->getResponsibleEmployee($request);
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
        $vendor = $this->vendor->getAllVendor();
        $employee = $this->employee->getResponsibleEmployee($request);
        $meuble = $this->meuble->getAllCategory();
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

    public function proceedPO($num)
    {
        // numPo, vendor, employeeName, date, validTo, totalItem, freightIn, totalPrice, totalDisc, totalPayment
        $this->procurement->proceedPO($num);
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

    //===============================================================================================================================================================================================================
    // Fungsi khusus untuk digunakan class lain
    //===============================================================================================================================================================================================================
    public function showDetail($numPO)
    {
        return $this->procurement->showDetailPO($numPO);
    }
}
