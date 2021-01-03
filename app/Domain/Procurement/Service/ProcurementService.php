<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, December 2020
 */

namespace App\Domain\Procurement\Service;

use App\Http\Controllers\Controller;
use App\Domain\Procurement\Dao\ProcurementDB;

class ProcurementService extends Controller
{
    private $procurement;

    public function __construct()
    {
        $this->procurement = new ProcurementDB();
    }

    public function index_open()
    {
        return $this->procurement->index_open();
    }

    public function index_history()
    {
        return $this->procurement->index_history();
    }

    public function show_header($numPO)
    {
        return $this->procurement->show_header($numPO);
    }

    public function get_last_numPO()
    {
        $numPO = $this->procurement->get_last_numPO();
        if (count($numPO) != 0) {
            return (string)(((int)$numPO[0]->numPO) + 1);
        }
        return "10000001";
    }

    public function store($request)
    {
        $this->procurement->store($request);
    }

    public function proceed($num)
    {
        $this->procurement->proceed($num);
    }

    public function cancel($num)
    {
        $this->procurement->cancel($num);
    }

    public function update($request)
    {
        $this->procurement->update($request);
    }
}
