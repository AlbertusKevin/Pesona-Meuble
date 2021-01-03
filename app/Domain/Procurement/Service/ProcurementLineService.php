<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, December 2020
 */

namespace App\Domain\Procurement\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Procurement\Dao\ProcurementLineDB;
use App\Domain\Procurement\Service\ProcurementService;

class ProcurementLineService extends Controller
{
    private $procurementline;

    public function __construct()
    {
        $this->procurementline = new ProcurementLineDB();
    }

    public function show_line($numPO)
    {
        return $this->procurementline->show_line($numPO);
    }

    public function store_line($request)
    {
        $this->procurementline->store_line($request);
    }

    public function delete_line($request)
    {
        $this->procurementline->delete_line($request);
    }
}
