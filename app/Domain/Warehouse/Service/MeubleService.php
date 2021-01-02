<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 */

namespace App\Domain\Warehouse\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Warehouse\Dao\MeubleDao;

class MeubleService extends Controller
{
    // Deklarasi variable global, untuk pemanggilan model ORM dan class agar bisa digunakan semua function di dalam class ini
    private $meubles;

    //==================================================================================================================================================
    // Inisialisasi secara otomatis model dan class yang akan digunakan untuk berinteraksi dengan database ketika class service ini di panggil
    //==================================================================================================================================================
    public function __construct()
    {
        $this->meubles = new MeubleDao();
    }

    public function new_meuble($request)
    {
        $pict = $request->file('picture');                  //mendapatkan nama file/image
        //upload file ke folder yang disediakan
        $pictName = $pict->getClientOriginalName();
        $targetUploadDesc = "images\\sales\\meuble";
        $pict->move($targetUploadDesc, $pictName);

        $pathDesc = $targetUploadDesc . "\\" . $pictName;   //membuat file path yang akan digunakan sebagai src html

        $this->meubles->insert($request, $pathDesc);
    }

    //mengambil data mebel yang sudah ada untuk field create PO
    public function search_meuble_with_vendor($data)
    {
        return $this->meubles->search_meuble_with_vendor($data);
    }

    //todo: kemungkinan, add stock dan reduce stock dapat direfactor sehingga cukup satu fungsi saja
    public function add_stock(Request $request)
    {
        $stock = $this->show_meuble($request['modelType']);
        $stock = $stock->stock;
        $stock += $request['quantity'];
        $this->meubles->update($request, $stock);
    }

    public function reduce_stock(Request $request)
    {
        $stock = $this->show_meuble($request['modelType']);
        $stock = $stock->stock;
        $stock -= $request['quantity'];
        $this->meubles->update($request, $stock);
    }
    //===============================================================================================================================================================================================================
    // Fungsi khusus untuk digunakan class lain
    //===============================================================================================================================================================================================================
    // menampilkan semua meuble
    public function index_meuble()
    {
        return $this->meubles->index_meuble();
    }

    // menampilkan data meuble tertentu
    public function show_meuble($model)
    {
        return $this->meubles->show_meuble($model);
    }

    public function show_category_description($category)
    {
        return $this->meubles->show_category($category);
    }

    // !================================================================

    public function getAllCategory()
    {
        return $this->meubles->showCategory();
    }
}
