<?php

namespace App\Domain\CustomerManagement\Dao;

use App\Http\Controllers\Controller;
use App\Domain\CustomerManagement\Entity\Customer;
use Illuminate\Http\Request;


class CustomerDB extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */

    public function findAllSalesOrders()
    {
        $customers = Customer::orderBy('id', 'asc');
        return $customers; 
    }

    public function fincCustomerByName($name)
    {
        $customer = Customer::where('name', '=', $name)->first();
        return $customer; 
    }

    public function createCustomer($header)
    {

    }

    
}
