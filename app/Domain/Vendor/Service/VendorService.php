<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, Mikhael Adriel, December 2020
 */

namespace App\Domain\Vendor\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Vendor\Dao\VendorDB;
use Illuminate\Support\Facades\Validator;


class VendorService extends Controller
{
    // Deklarasi kelas global, untuk pemanggilan model ORM
    private $vendors;

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function __construct()
    {
        $this->vendors = new VendorDB();
    }

    public function listView()
    {
        $vendors = $this->vendors->showAll();
        return view('vendor.vendorList', [
            "vendors" => $vendors,
        ]);
    }

    public function detailView($companyCode)
    {
        $vendor = $this->vendors->findVendorByCompanyCode($companyCode);
        return view('vendor.vendorDetail', [
            "vendor" => $vendor,
        ]);
    }

    public function createView()
    {
        return view('vendor.newVendor');
    }

    public function addNewVendor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'companyCode' => 'required|unique:vendor',
            'name' => 'required',
            'email' => 'required', 
            'telephone' => 'required', 
            'address' => 'required', 
        ]);
        
        if ($validator->fails()) {
            return redirect('/vendor/create')
                ->withInput()
                ->withErrors($validator);
        }
        return redirect('/vendor/list')->with(['success' => 'New Vendor Addedd Successfully !']);
    }

    public function updateViewVendors($id)
    {
        $vendor = $this->vendors->findVendorByCompanyCode($id);
        // dd($vendor);
        return view('vendor.updatevendor', [
            "vendor" => $vendor
        ]);
    }

    public function updateVendors(Request $request, $companyCode)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required', 
            'telephone' => 'required',
            'address' => 'required'
        ]);
    
        if ($validator->fails()) {
            return redirect('/vendor/update/'. $companyCode)
                ->withInput()
                ->withErrors($validator);
        }
        $vendors = $this->vendors->updateVendors($request, $companyCode);
        return redirect("/vendor/list")->with(['success' => 'Vendor '. $request->name.' Updated Successfully !']);
    }
}