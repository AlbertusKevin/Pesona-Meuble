<?php

namespace App\Domain\Employee\Dao;

use App\Domain\Employee\Entity\Employee;

class EmployeeDB
{
    public function showAll()
    {
        return Employee::all();
    }

    public function findByEmail($request)
    {
        return Employee::where('email', $request->email)->first();
    }

    public function findById($id)
    {
        return Employee::where('id', $id)->first();
    }

    public function findByName($request)
    {
        return Employee::where('name',$request->name)->first();
    }
}
