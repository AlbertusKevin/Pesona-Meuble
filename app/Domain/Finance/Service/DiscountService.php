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
use App\Domain\Employee\Dao\EmployeeDB;
use Illuminate\Support\Facades\Validator;

class DiscountService extends Controller
{
    // Deklarasi kelas global, untuk pemanggilan model ORM
    private $discounts;
    private $employees;

    public function __construct()
    {
        $this->discounts = new DiscountDB();
        $this->employees = new EmployeeDB();
    }

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================

    // public function createNewCustomer(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|min:4',
    //         'email' => 'required', 
    //         'phone' => 'required', 
    //         'address' => 'required'
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect('/customer/create/')
    //             ->withInput()
    //             ->withErrors($validator);
    //     }

    //     $this->customers->create($request);
    //     return redirect('/customer/list')->with(['success' => 'Customer ' . $request->customerName . 'successfully created !']);
    // }

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
        $employee = $this->employees->findById($request->session()->get('id_employee'));
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





    // public function createViewCustomers() {
    //     return view('customer_service.customer_data.createCustomer');
    // }

    // public function updateViewCustomers($id)
    // {
    //     $customers = $this->customers->findById($id);
    //     return view('customer_service.customer_data.updatecustomer', [
    //         "customers" => $customers
    //     ]);
    // }

    // public function updateCustomers(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|min:4',
    //         'email' => 'required', 
    //         'phone' => 'required', 
    //         'address' => 'required'
    //         // 'memberId' => 'required' 
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect('/customer/update/'. $id)
    //             ->withInput()
    //             ->withErrors($validator);
    //     }
    //     $customers = $this->customers->updateCustomers($request, $id);
    //     return redirect('/customer/list')->with(['success' => 'Customer '. $request->name.' Updated Successfully !']);
    // }

    // public function updateMemberCustomer(Request $request, $id)
    // {
    //     $customers = $this->customers->updateMember($id);
    //     return redirect('/customer/list')->with(['success' => 'Customer '. $request->name.' Successfully Registered as a Member  !']);
    // }
}
