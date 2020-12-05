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

    public function findCustomerByID($id)
    {
        $customer = Customer::where('id', '=', $id)->first();
        return $customer; 
    }

    public function create($line)
    {
        Customer::create([
            'name' => $line["name"],
            'email' => $line["email"],
            'phone' => (int)$line["phone"],
            'address' => $line["address"],
            'memberId' => 0
        ]);
    }

    public function showAll()
    {
        return Customer::all();
    }

    public function findById($id)
    {
        return Customer::where('id', $id)->first();
    }

    public function updateCustomers(Request $request, $id)
    {
        Customer::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
            // 'memberId' => $request->memberId,
        ]);
    }
}
