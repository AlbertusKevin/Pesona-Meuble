<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Chris Christian, Mikhael Adriel, December 2020
 */

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
    public function findById($id)
    {
        return Customer::where('id', $id)->first();
    }

    public function create($line)
    {
        Customer::create([
            'name' => $line["name"],
            'email' => $line["email"],
            'phone' => (int)$line["phone"],
            'address' => $line["address"],
            'member' => 0
        ]);
    }

    public function showAll()
    {
        return Customer::all();
    }


    public function updateCustomers(Request $request, $id)
    {
        Customer::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ]);
    }

    public function updateMember($id)
    {
        Customer::where('id', $id)->update([
            'member' => 1,
        ]);
    }
}
