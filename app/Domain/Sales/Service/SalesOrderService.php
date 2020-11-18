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

    public function createView() { 
        $meubles =$this->meubles->findAllMeubles(); 
        $employees = $this->employees->showAll(); 
        $discounts = $this->discounts->showAll();
        return view('sales.sales_order.createSalesOrder', [
            'meubles' => $meubles,
            'employees' => $employees,
            'discounts' => $discounts,
        ]);

    }



    public function validateCreate(Request $request)
    {
        
    }

    public function validateUpdate(Request $request)
    {
        
    }

    
}
