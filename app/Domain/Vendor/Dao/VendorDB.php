<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Chris Christian, Mikhael Adriel, December 2020
 */

namespace App\Domain\Vendor\Dao;

use App\Http\Controllers\Controller;
use App\Domain\Vendor\Entity\Vendor;
use Illuminate\Http\Request;


class VendorDB
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */
    public static function vendor_by_code($code)
    {
        return Vendor::where('companyCode', $code)->first();
    }

    public static function index()
    {
        return Vendor::all();
    }

    public function new_vendor($request)
    {
        Vendor::create([
            'companyCode' => $request->companyCode,
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'status' => 1
        ]);
    }

    public function update_vendor($request, $id)
    {
        Vendor::where('companyCode', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'address' => $request->address
        ]);
    }

    public function change_status($code, $status)
    {
        Vendor::where('companyCode', $code)->update([
            'status' => $status
        ]);
    }
}
