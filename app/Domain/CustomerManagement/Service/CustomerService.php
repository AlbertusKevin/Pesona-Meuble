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
    private $employee;

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function __construct()
    {
        $this->customers = new CustomerDB();
        $this->employee = new EmployeeDB();
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
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $this->customers->create($request);
        return redirect()->back()->with(['success' => 'Customer ' . $request->customerName . 'successfully created !']);
    }

    public function showCustomers($id) {
        $customers = $this->customers->showAll();
        $employee = $this->employee->findById($id);
        return view('customer_service.customer_data.customerlist', [
            "customers" => $customers, 
            "employee" => $employee
        ]);
    }

    public function updateViewCustomers($id)
    {
        $customers = $this->customers->findById($id);
        $employee = $this->employee->findById($id);
        return view('customer_service.customer_data.updatecustomer', [
            "customers" => $customers, 
            "employee" => $employee
        ]);
    }

    public function updateCustomers(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required', 
            'phone' => 'required', 
            'address' => 'required'
            // 'memberId' => 'required' 
        ]);
    
        if ($validator->fails()) {
            return redirect('/customers/update/'. $id)
                ->withInput()
                ->withErrors($validator);
        }
        $customers = $this->customers->updateCustomers($request, $id);
        return redirect('/customers')->with(['success' => 'Customer '. $request->name.' Updated Successfully !']);
    }
}
