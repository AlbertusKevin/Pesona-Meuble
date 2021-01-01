<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, December 2020
 */

namespace App\Domain\Employee\Service;

use App\Http\Controllers\Controller;
use App\Domain\Employee\Dao\EmployeeDB as Employee;
use App\Domain\Procurement\Service\MeubleService as Meuble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthService extends Controller
{
    // Deklarasi variable global, untuk pemanggilan model ORM dan class agar bisa digunakan semua function di dalam class ini
    private $employee_dao;

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model dan class yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function __construct()
    {
        $this->employee_dao = new Employee();
    }

    public function login_service($request)
    {
        $employee = $this->employee_dao->authenticate_employee($request);

        if (isset($employee)) {
            $check = Hash::check($request->password, $employee->password);
            if ($check) {
                session(['login' => true, 'id_employee' => $employee->id]);
                return true;
            }
        }
        return false;
    }
}
