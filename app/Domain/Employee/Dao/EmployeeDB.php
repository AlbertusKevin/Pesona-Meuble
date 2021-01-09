<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 */

namespace App\Domain\Employee\Dao;

use App\Domain\Employee\Entity\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeDB
{
    public function authenticate_employee($request)
    {
        return Employee::where('email', $request->email)->where('status', 1)->first();
    }

    public function index_employee()
    {
        return Employee::all();
    }

    public function show_by_id($id)
    {
        return Employee::where('id', $id)->first();
    }

    public function new_employee(Request $request)
    {
        Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'raiseIteration' => 0,
            'role' => $request->role,
            'status' => 1,
            'salary' => 5000000,
        ]);
    }

    public function update_employee(Request $request, $id)
    {
        if ($id != 1) {
            Employee::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'role' => $request->role,
            ]);
        } else {
            Employee::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address
            ]);
        }
    }
    public function resign($id)
    {
        Employee::where('id', $id)->update([
            'status' => 0,
        ]);
    }

    public function update_salary($id, $salary, $raiseIteration)
    {
        Employee::where('id', $id)->update([
            'salary' => $salary,
            'raiseIteration' => $raiseIteration++,
        ]);
    }

    // TODO: Refactor this code =================================================================================
    public function findByName(Request $request)
    {
        return Employee::where('name', $request->name)->first();
    }
}
