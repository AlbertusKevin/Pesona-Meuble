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
    private $employees;

    public function __construct()
    {
        $this->employees = new EmployeeDB();
    }

    public function listView()
    {
        $employees = $this->employees->showAll();
        return view('employee.employee_data.employeeList', [
            'employees' => $employees,
        ]);
    }

    public function detailView($id)
    {
        $employee = $this->employees->findById($id);
        $currentSalary = ($employee->raiseIteration * 500000) + 5000000;
        return view('employee.employee_data.employeeDetail', [
            'employee' => $employee,
            'currentSalary' => $currentSalary,
        ]);
    }

    public function updateView($id)
    {
        $employee = $this->employees->findById($id);
        return view('employee.employee_data.employeeUpdate', [
            'employee' => $employee,
        ]);
    }

    public function raiseSalaryView($id)
    {
        $employee = $this->employees->findById($id);
        return view('employee.employee_data.employeeRaiseSalary', [
            'employee' => $employee,
        ]);
    }

    public function newEmployeeView()
    {
        return view('employee.employee_data.newEmployee');
    }

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

    public function resignEmployee(Request $request, $id)
    {
        $this->employees->updateResign($id);
        return redirect('/employee/list')->with(['success' => 'Employee ' . $request->name . ' has been resigned !']);
    }

    public function raiseSalary(Request $request, $id)
    {
        $salary = $request->salary + $request->raise;
        $raiseIteration = $request->raiseIteration + 1;
        $this->employees->updateSalary($id, $salary, $raiseIteration);
        return redirect('/employee/list')->with(['success' => 'Employee ' . $request->name . ' salary has been raised successfully!']);
    }

    //===============================================================================================================================================================================================================
    // Bukan fungsi dipanggil dari route
    //===============================================================================================================================================================================================================
    public function getResponsibleEmployee($request)
    {
        return $this->employees->findById($request->session()->get('id_employee'));
    }
}
