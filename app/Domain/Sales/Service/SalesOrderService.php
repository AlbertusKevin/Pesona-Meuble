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
use App\Domain\Warehouse\Service\MeubleService;
use App\Domain\Finance\Service\DiscountService;
use Illuminate\Http\Request;

class SalesOrderService extends Controller
{
    private $salesorders;

    public function __construct()
    {
        $this->salesorders = new SalesOrderDao();
    }

    public function index()
    {
        return $this->salesorders->index();
    }

    public function index_history()
    {
        return $this->salesorders->index_history();
    }

    public function get_last_numSO()
    {
        $numSO = $this->salesorders->get_last_numSO();
        if (count($numSO) != 0) {
            return (string)(((int)$numSO[0]->numSO) + 1);
        }
        return $numSO = "20000001";
    }

    public function get_by_customer_and_numSO($numSO)
    {
        return $this->salesorders->get_by_customer_and_numSO($numSO);
    }

    public function store_header($data)
    {
        $this->salesorders->store_header($data);
    }

    public function update_header($request)
    {
        $this->salesorders->update_header($request);
    }

    public function proceed($numSO)
    {
        $this->salesorders->proceed($numSO);
    }
    public function cancel($numSO)
    {
        $this->salesorders->cancel($numSO);
    }
}
