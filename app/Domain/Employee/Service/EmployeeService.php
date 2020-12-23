<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Chris Christian, December 2020
 */

namespace App\Domain\Employee\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Employee\Dao\EmployeeDB;
use Illuminate\Support\Facades\Validator;

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

    //menampilkan semua daftar employee
    public function listView()
    {
        $employees = $this->employees->showAll();
        return view('employee.employee_data.employeeList', [
            'employees' => $employees,
        ]);
    }

    //detail view salah satu employee berdasarkan id
    public function detailView($id)
    {
        $employee = $this->getEmployeeById($id);
        $currentSalary = ($employee->raiseIteration * 500000) + 5000000;
        return view('employee.employee_data.employeeDetail', [
            'employee' => $employee,
            'currentSalary' => $currentSalary,
        ]);
    }

    //update data employee berdasarkan id
    public function updateView($id)
    {
        $employee = $this->getEmployeeById($id);
        return view('employee.employee_data.employeeUpdate', [
            'employee' => $employee,
        ]);
    }

    //ubah gaji karyawan dengan id tertentu
    public function raiseSalaryView($id)
    {
        $employee = $this->getEmployeeById($id);
        return view('employee.employee_data.employeeRaiseSalary', [
            'employee' => $employee,
        ]);
    }

    //view untuk input data customer baru
    public function newEmployeeView()
    {
        return view('employee.employee_data.newEmployee');
    }

    //proses input data employee yang baru
    public function addNewEmployee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
            'role' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/employee/create')
                ->withInput()
                ->withErrors($validator);
        }
        $this->employees->createEmployee($request);
        return redirect('/employee/list')->with(['success' => 'New Employee Addedd Successfully !']);
    }

    //update data profile employee berdasarkan id
    public function updateEmployee(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4',
            'role' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/employee/update/' . $id)
                ->withInput()
                ->withErrors($validator);
        }
        $this->employees->updateEmployee($request, $id);
        return redirect('/employee/list')->with(['success' => 'Employee ' . $request->name . ' Updated Successfully !']);
    }

    //ketika employee ada yang mengundurkan diri
    public function resignEmployee(Request $request, $id)
    {
        $this->employees->updateResign($id);
        return redirect('/employee/list')->with(['success' => 'Employee ' . $request->name . ' has been resigned !']);
    }

    //update gaji karyawan, berdasarkan kenaikan gaji yang ditentukan
    public function raiseSalary(Request $request, $id)
    {
        $salary = $request->salary + $request->raise;
        $raiseIteration = $request->raiseIteration + 1;
        $this->employees->updateSalary($id, $salary, $raiseIteration);
        return redirect('/employee/list')->with(['success' => 'Employee ' . $request->name . ' salary has been raised successfully!']);
    }

    //===============================================================================================================================================================================================================
    // Fungsi khusus untuk digunakan class lain
    //===============================================================================================================================================================================================================
    public function getResponsibleEmployee($request)
    {
        return $this->getEmployeeById($request->session()->get('id_employee'));
    }

    public function getEmployeeById($id)
    {
        return $this->employees->findById($id);
    }
}
