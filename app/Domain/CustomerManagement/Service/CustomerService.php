<?php

namespace App\Domain\CustomerManagement\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\CustomerManagement\Dao\CustomerDB;

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
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $this->customers->create($request);
        return redirect()->back()->with('success_new_customer', 'Customer ' . $request->customerName . 'successfully created !');
    }
}
