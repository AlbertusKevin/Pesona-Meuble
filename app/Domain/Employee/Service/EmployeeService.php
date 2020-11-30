<?php

namespace App\Domain\Employee\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Vendor\Dao\EmployeeDB;

class EmployeeService extends Controller
{
    // Deklarasi kelas global, untuk pemanggilan model ORM
    private $vendor;
    private $name;
    private $email;
    private $telephone;
    private $address;
    private $ComCode;

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function __construct()
    {
        $this->vendor = new VendorDB();
    }

    //==================================================================================================================================================
    // Ambil data Vendor (View)
    //==================================================================================================================================================
    // menampilkan semua vendor bagian header
    public function show($id)
    {
        $vendor = $this->vendor->findByCC($id);
        return view('vendor.listVendor', [
            "name" => $name,
            "email"=> $email;
        ]);
    }

    //menampilkan detail line item dari salah satu procurement
    public function detail($id)
    {
        $vendor = $this->vendor->findByCC($id);
        return view('vendor.detailVendor', [
            "companyCode" => $id,
            "name" => $name,
            "email" => $email,
            "telephone" => $telephone,
            "address" => $address;
        ]);
    }

    //==================================================================================================================================================
    // Insert data Vendor
    //==================================================================================================================================================
    //mengambil view create pembelian barang
    public function viewCreate($id)
    {

        $ComCode = $this->vendor->findByCC($id);
        if ($ComCode != $id) {
            return view('vendor.newVendor', [
           "companyCode" => $id,
            "name" => $name,
            "email" => $email,
            "telephone" => $telephone,
            "address" => $address;
        ]);
        } else {
            return view('vendor.editVendor', [
            "name" => $name,
            "email" => $email,
            "telephone" => $telephone,
            "address" => $address;
        ]);
        }

        
    }

    // Insert Header dari PO
    public function createHeader($id)
    {
        // companyCode, name, email, telno, address
        $this->vendor->insertHeader($_POST);
    }

    
}
