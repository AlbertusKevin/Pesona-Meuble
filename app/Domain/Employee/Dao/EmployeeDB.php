<?php

namespace App\Domain\Employee\Dao;

use App\Domain\Employee\Entity\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeDB
{
    public function showAll()
    {
        return Employee::all();
    }

    public function findByEmail(Request $request)
    {
        return Employee::where('email', $request->email)->first();
    }

    public function findById($id)
    {
        return Employee::where('id', $id)->first();
    }

    public function findByName(Request $request)
    {
        return Employee::where('name',$request->name)->first();
    }

    public function createEmployee(Request $request)
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

    public function updateEmployee(Request $request, $id)
    {
        Employee::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role,
            'salary' => 5000000,
        ]);
    }

    public function updateResign($id)
    {
        Employee::where('id', $id)->update([
            'status' => 0,
        ]);
    }

    public function updateSalary($id, $salary, $raiseIteration)
    {
        Employee::where('id', $id)->update([
            'salary' => $salary,
            'raiseIteration' => $raiseIteration++,
        ]);
    }


}
