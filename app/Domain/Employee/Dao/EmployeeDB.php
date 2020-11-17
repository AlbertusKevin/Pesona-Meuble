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
}
