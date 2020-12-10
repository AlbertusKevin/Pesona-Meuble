<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 */

namespace App\Domain\Sales\Service;

use App\Http\Controllers\Controller;
use App\Domain\Sales\Dao\SalesOrderDao;
use App\Domain\Sales\Service\SalesOrderLineService;
use App\Domain\Employee\Service\EmployeeService;
use App\Domain\Procurement\Service\MeubleService;
use App\Domain\Finance\Service\DiscountService;
use Illuminate\Http\Request;

class SalesOrderService extends Controller
{
    // Deklarasi variable global, untuk pemanggilan model ORM dan class agar bisa digunakan semua function di dalam class ini
    private $salesorders;
    private $salesorderlines;
    private $employees;
    private $meubles;
    private $discounts;

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model dan class yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function __construct()
    {
        $this->salesorders = new SalesOrderDao();
        $this->salesorderlines = new SalesOrderLineService();
        $this->employees = new EmployeeService();
        $this->meubles = new MeubleService();
        $this->discounts = new DiscountService();
    }

    public function listView()
    {
        $salesorders = $this->salesorders->findAllSalesOrders();
        return view('sales.sales_order.listSalesOrder', [
            'salesorders' => $salesorders,
        ]);
    }

    public function historyView()
    {
        $salesorders = $this->salesorders->findSalesOrderHistory();
        return view('sales.sales_order.historySalesOrder', [
            'salesorders' => $salesorders,
        ]);
    }

    public function salesOrderDetailView($numSO)
    {
        $salesorder = $this->salesOrderNumAndCustomer($numSO);
        // $discounts = $this->discounts->showAllDiscount();
        $salesorderlines = $this->salesorderlines->detailSalesOrderLine($numSO);

        return view('sales.sales_order.updateSalesOrderView', [
            'salesorder' => $salesorder,
            'salesorderlines' => $salesorderlines
            // 'discounts' => $discounts
        ]);
    }
    public function salesOrderDetaiHistory($numSO)
    {
        $salesorder = $this->salesOrderNumAndCustomer($numSO);
        $salesorderlines = $this->salesorderlines->detailSalesOrderLine($numSO);
        return view('sales.sales_order.detailHistorySalesOrder', [
            'salesorder' => $salesorder,
            'salesorderlines' => $salesorderlines,
        ]);
    }

    public function createView(Request $request)
    {
        $meubles = $this->meubles->listMeuble();
        $employee = $this->employees->getResponsibleEmployee($request);
        // $discMeuble = $this->discounts->forMeuble();
        // $discPayment = $this->discounts->forPayment();
        $numSO = $this->salesorders->findLastNumSO();

        if (count($numSO) != 0) {
            $numSO = $numSO[0]->numSO;
            $numSO = ((int)$numSO) + 1;
            $numSO = (string)$numSO;
        } else {
            $numSO = "20000001";
        }

        return view('sales.sales_order.createSalesOrder', [
            'meubles' => $meubles,
            'employee' => $employee,
            // 'discMeuble' => $discMeuble,
            // 'discPayment' => $discPayment,
            'numSO' => $numSO
        ]);
    }

    public function createHeader()
    {
        // numPo, vendor, employeeName, date, validTo, totalItem, freightIn, totalPrice, totalDisc, totalPayment
        $this->salesorders->createSalesOrder($_POST);
    }

    public function updateHeader(Request $request)
    {
        // numPo, vendor, employeeName, date, validTo, totalItem, freightIn, totalPrice, totalDisc, totalPayment
        $this->salesorders->updateSalesOrder($request);
    }

    public function proceedSO($numSO)
    {
        // numPo, vendor, employeeName, date, validTo, totalItem, freightIn, totalPrice, totalDisc, totalPayment
        $this->salesorders->updateProceed($numSO);
    }
    public function cancelSO($numSO)
    {
        // numPo, vendor, employeeName, date, validTo, totalItem, freightIn, totalPrice, totalDisc, totalPayment
        $this->salesorders->cancelSO($numSO);
        return redirect('/salesorder')->with(['success' => 'Sales Order  ' . $numSO . ' canceled !']);
    }

    public function finishSO($numSO)
    {
        // numPo, vendor, employeeName, date, validTo, totalItem, freightIn, totalPrice, totalDisc, totalPayment
        $this->salesorders->updateFinish($numSO);
        return redirect('/salesorder')->with('success', 'Sales Order  ' . $numSO . ' finished successfully !');
    }

    //===============================================================================================================================================================================================================
    // Fungsi khusus untuk digunakan class lain
    //===============================================================================================================================================================================================================
    public function salesOrderNumAndCustomer($numSO)
    {
        return $this->salesorders->findSalesOrderByNumSOWithCustomer($numSO);
    }
}
