<?php

namespace App\Domain\Vendor\Dao;

use App\Http\Controllers\Controller;
use App\Domain\Vendor\Entity\Vendor;

class VendorDB 
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */
     public static function findVendorByCompanyCode($id){
          return Vendor::where('companyCode', $id)->first();
     }

    public static function showAll()
    {
        $vendor = Vendor::all();
        return $vendor;
    }

    //insert data header dari Vendorservice ke tabel vendor
    public function createVendor($request)
    {
        Vendor::create([
            'companyCode' => $request->companyCode,
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'address' => $request->address,
        ]);
    }
}
