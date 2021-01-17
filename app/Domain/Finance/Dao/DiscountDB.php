<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 */

namespace App\Domain\Finance\Dao;

use App\Domain\Finance\Entity\Discount;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DiscountDB
{
    public function index()
    {
        return Discount::all();
    }

    public function discount_by_code($code)
    {
        return Discount::where('code', $code)
            ->join('employee', 'discount.responsibleEmployee', '=', 'employee.id')
            ->first();
    }

    public function new_discount(Request $request)
    {
        Discount::create([
            'code' => $request->code,
            'description' => $request->description,
            'percentDisc' => (float)$request->percentDisc / 100,
            'responsibleEmployee' => $request->employeeID,
            'statusActive' => 1,
            'from' => Carbon::parse($request->from)->format('Y-m-d'),
            'to' => Carbon::parse($request->to)->format('Y-m-d')
        ]);
    }

    public function update_status($code)
    {
        return Discount::where('code', $code)->update([
            'statusActive' => 0,
        ]);
    }

    public function update_data($request, $code)
    {
        return Discount::where('code', $code)->update([
            'description' => $request->description,
            'percentDisc' => (float)$request->percentDisc / 100
        ]);
    }

    public function delete_discount($code)
    {
        return Discount::where('code', $code)->delete();
    }
}
