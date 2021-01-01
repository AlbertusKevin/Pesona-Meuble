<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author: 
 *      Albertus Kevin, Januari 2021 
 *      Chris Christian, December 2020
 */

namespace App\Domain\Employee\Service;

use App\Http\Controllers\Controller;
use App\Domain\Employee\Dao\EmployeeDB;

class EmployeeService extends Controller
{
    // Deklarasi variable global, untuk pemanggilan model ORM dan class agar bisa digunakan semua function di dalam class ini
    private $employees;

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model dan class yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function __construct()
    {
        $this->employees = new EmployeeDB();
    }

    public function index_employee()
    {
        return $this->employees->index_employee();
    }

    public function store($request)
    {
        $this->employees->new_employee($request);
    }

    public function update_employee($request, $id)
    {
        $this->employees->update_employee($request, $id);
    }

    public function resign($id)
    {
        $this->employees->resign($id);
    }

    public function update_salary($request, $id)
    {
        $salary = $request->salary + $request->raise;
        $raiseIteration = $request->raiseIteration + 1;
        $this->employees->update_salary($id, $salary, $raiseIteration);
    }

    public function get_employee_by_id($id)
    {
        return $this->employees->show_by_id($id);
    }

    // TODO: Refactor this code =================================================================================
    public function getResponsibleEmployee($request)
    {
        return $this->getEmployeeById($request->session()->get('id_employee'));
    }
}
