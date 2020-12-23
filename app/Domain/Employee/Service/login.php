<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, December 2020
 */

namespace App\Domain\Employee\Service;

use App\Http\Controllers\Controller;
use App\Domain\Employee\Dao\EmployeeDB as Employee;
<<<<<<< HEAD
use App\Domain\Procurement\Dao\MeubleDao as Meuble;
=======
use App\Domain\Procurement\Service\MeubleService as Meuble;
>>>>>>> 10a72466cfe866f3fa8ce0d8d16161d836cc1035
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */

    // Deklarasi variable global, untuk pemanggilan model ORM dan class agar bisa digunakan semua function di dalam class ini
    private $emp;
    private $meubles;

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model dan class yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function __construct()
    {
        $this->emp = new Employee();
        $this->meubles = new Meuble();
    }

    public function login_view()
    {
        return view('employee.login.login');
    }

    public function login_process(Request $request)
    {
        $request->validate([
            'email' => 'required | email',
            'password' => 'required'
        ]);

        $employee = $this->emp->loginEmployee($request);

        if (isset($employee)) {
            $check = Hash::check($request->password, $employee->password);
            if ($check) {
                session(['login' => true, 'id_employee' => $employee->id, 'role' => $employee->role]);
                return redirect('/admin');
            } else {
                return redirect()->back()->with('failed_login', 'Wrong password or username!')->withInput();
            }
        } else {
            return redirect()->back()->with('failed_login', 'Wrong password or username!')->withInput();
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }

    public function homeAdmin()
    {
<<<<<<< HEAD
        $meubles = $this->meubles->findAllMeubles();
=======
        $meubles = $this->meubles->listMeuble();
>>>>>>> 10a72466cfe866f3fa8ce0d8d16161d836cc1035
        return view('employee.home', compact('meubles'));
    }
}
