<?php

namespace App\Domain\Vendor\Dao;

use App\Http\Controllers\Controller;
use App\Domain\Vendor\Entity\Vendor;

class VendorDB extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */
     public static function findByCC($id){
          return Vendor::where('companyCode', $id)->first();
     }

    public static function showAll()
    {
        $vend = Vendor::all();
        return $vend;
    }

    //insert data header dari Vendorservice ke tabel vendor
    public function insertHeader($header)
    {
        PurchaseOrder::create([
            'companyCode' => $header["companyCode"],
            'name' => $header["name"],
            'address' => $header["address"],
            'email' => ($header["email"]),
            'telephone' => ($header["telephone"]),
        ]);
    }
}
