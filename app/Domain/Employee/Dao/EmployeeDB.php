<?php

namespace App\Domain\Employee\Dao;

use App\Domain\Employee\Entity\Employee as EntityEmployee;

class EmployeeDB
{
    public function findEmployee($request)
    {
        return EntityEmployee::where('email', $request->email)->first();
    }
}
