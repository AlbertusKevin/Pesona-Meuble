<?php

namespace App\Domain\Sales\Service;

use App\Http\Controllers\Controller;
use App\Domain\Sales\Entity\SalesOrder;
use App\Domain\Sales\Dao\SalesOrderDao;
use App\Domain\Employee\Dao\EmployeeDB;
use App\Domain\Procurement\Dao\MeubleDao;
use App\Domain\Finance\Dao\DiscountDB;
use Illuminate\Http\Request;

class SalesOrderService extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */

    private $salesorders; 
    private $employees;
    private $meubles;
    private $discounts;

    public function __construct()
    {
        $this->salesorders = new SalesOrderDao();
        $this->employees = new EmployeeDB();
        $this->meubles = new MeubleDao();
        $this->discounts = new DiscountDB();

    }

    

    public function listView() { 
        $salesorders = $this->salesorders->findAllSalesOrders();
        return view('sales.sales_order.listSalesOrder', [
            'salesorders' => $salesorders,
        ]);

    }

    public function historyView() { 
        $salesorders = $this->salesorders->findAllSalesOrders();
        return view('sales.sales_order.historySalesOrder', [
            'salesorders' => $salesorders,
        ]);

    }

    public function salesOrderDetailView($numSO) { 
        $salesorder = SalesOrderDao::findSalesOrderByNumSO($numSO);
        return view('sales.sales_order.salesOrderDetail')->with('salesorder', $salesorder);
    }

    public function createView($id) { 
        $meubles =$this->meubles->findAllMeubles(); 
        $employee = $this->employees->findById($id);
        $discounts = $this->discounts->showAll();
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
            'discounts' => $discounts,
            'numSO' => $numSO
        ]);

    }

    public function createHeader()
    {
        // numPo, vendor, employeeName, date, validTo, totalItem, freightIn, totalPrice, totalDisc, totalPayment
        $this->salesorders->createSalesOrder($_POST);
    }

    
}
