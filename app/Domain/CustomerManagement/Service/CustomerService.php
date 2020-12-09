<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Chris Christian, Mikhael Adriel, December 2020
 */

namespace App\Domain\CustomerManagement\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\CustomerManagement\Dao\CustomerDB;
use App\Domain\Employee\Dao\EmployeeDB;
use Illuminate\Support\Facades\Validator;

class CustomerService extends Controller
{
    // Deklarasi kelas global, untuk pemanggilan model ORM
    private $customers;

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function __construct()
    {
        $this->customers = new CustomerDB();
    }

    public function generateCustomerForSalesOrder()
    {
        $customer = $this->customers->findCustomerByID($_GET['model']);
        if (isset($customer)) {
            return $customer;
        }
        return json_encode($customer);
    }

    public function createNewCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/customer/create/')
                ->withInput()
                ->withErrors($validator);
        }

        $this->customers->create($request);
        return redirect('/customer/list')->with(['success' => 'Customer ' . $request->customerName . 'successfully created !']);
    }

    public function showCustomers()
    {
        $customers = $this->customers->showAll();
        return view('customer_service.customer_data.customerlist', [
            "customers" => $customers,
        ]);
    }

    public function createViewCustomers()
    {
        return view('customer_service.customer_data.createCustomer');
    }

    public function updateViewCustomers($id)
    {
        $customers = $this->customers->findById($id);
        return view('customer_service.customer_data.updatecustomer', [
            "customers" => $customers
        ]);
    }

    public function updateCustomers(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/customer/update/' . $id)
                ->withInput()
                ->withErrors($validator);
        }
        $this->customers->updateCustomers($request, $id);
        return redirect('/customer/list')->with(['success' => 'Customer ' . $request->name . ' Updated Successfully !']);
    }

    public function updateMemberCustomer(Request $request, $id)
    {
        $this->customers->updateMember($id);
        return redirect('/customer/list')->with(['success' => 'Customer ' . $request->name . ' Successfully Registered as a Member  !']);
    }
}
