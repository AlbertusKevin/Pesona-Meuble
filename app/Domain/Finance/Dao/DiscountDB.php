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
    public function showAll()
    {
        return Discount::all();
    }

    public function forMeuble()
    {
        return Discount::where('discountFor', 1)->where('statusActive', 1)->get();
    }

    public function forPayment()
    {
        return Discount::where('discountFor', 0)->where('statusActive', 1)->get();
    }

    public function findDiscountByCode($code)
    {
        return Discount::where('code', $code)
            ->join('employee', 'discount.responsibleEmployee', '=', 'employee.id')
            ->first();
    }

    public function createDiscount(Request $request)
    {
        Discount::create([
            'code' => $request->code,
            'description' => $request->description,
            'percentDisc' => (float)$request->percentDisc / 100,
            'responsibleEmployee' => $request->employeeID,
            'statusActive' => 1,
            'from' => Carbon::parse($request->from)->format('Y-m-d'),
            'to' => Carbon::parse($request->to)->format('Y-m-d'),
            'discountFor' => $request->discFor
        ]);
    }

    public function updateStatus($code)
    {
        return Discount::where('code', $code)->update([
            'statusActive' => 0,
        ]);
    }

    public function deleteDiscount($code)
    {
        return Discount::where('code', $code)->delete();
    }
}
