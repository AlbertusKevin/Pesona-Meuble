<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Chris Christian, December 2020
 */

namespace App\Domain\Finance\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Finance\Dao\DiscountDB;
use App\Domain\Employee\Service\EmployeeService;
use Illuminate\Support\Facades\Validator;

class DiscountService extends Controller
{
    // Deklarasi variable global, untuk pemanggilan model ORM dan class agar bisa digunakan semua function di dalam class ini
    private $discounts;
    private $employees;

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model dan class yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function __construct()
    {
        $this->discounts = new DiscountDB();
        $this->employees = new EmployeeService();
    }

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function listView()
    {
        $discounts = $this->discounts->showAll();
        return view('finance.discount.discountList', [
            "discounts" => $discounts,
        ]);
    }

    public function detailView($code)
    {
        $discount = $this->discounts->findDiscountByCode($code);
        return view('finance.discount.discountDetail', [
            "discount" => $discount,
        ]);
    }

    public function createView(Request $request)
    {
        $employee = $this->employees->getResponsibleEmployee($request);
        return view('finance.discount.newDiscount', [
            "employee" => $employee,
        ]);
    }

    public function createNewDiscount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|min:4|unique:discount',
            'description' => 'required',
            'percentDisc' => 'required',
            'from' => 'required',
            'to' => 'required',
            'discFor' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/discount/create')
                ->withInput()
                ->withErrors($validator);
        }

        $this->discounts->createDiscount($request);
        return redirect('/discount/list')->with(['success' => 'Discount ' . $request->code . 'successfully created !']);
    }

    public function updateStatusDiscount($code)
    {
        $discount = $this->discounts->updateStatus($code);
        return redirect('/discount/list')->with(['success' => 'Discount ' . $code . ' Updated Expired Successfully !']);
    }

    public function deleteDiscount($code)
    {
        $discount = $this->discounts->deleteDiscount($code);
        return redirect('/discount/list')->with(['success' => 'Discount ' . $code . ' Deleted !']);
    }

    //===============================================================================================================================================================================================================
    // Fungsi khusus untuk digunakan class lain
    //===============================================================================================================================================================================================================
    public function showAllDiscount()
    {
        return $this->discounts->showAll();
    }
}
