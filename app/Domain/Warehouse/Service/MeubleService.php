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

    public function insert(Request $request)
    {
        $request->validate([
            'modelType' => 'required',
            'meubleName' => 'required',
            'category' => 'required',
            'size' => 'required',
            'color' => 'required',
            'description' => 'required',
            'warranty' => 'required',
            'price' => 'required',
            'vendor' => 'required',
            'picture' => 'required'
        ]);
        $pict = $request->file('picture');
        //mendapatkan nama file/image
        $pictName = $pict->getClientOriginalName();
        //upload file ke folder yang disediakan
        $targetUploadDesc = "images\\sales\\meuble";
        $pict->move($targetUploadDesc, $pictName);
        //membuat file path yang akan digunakan sebagai src html
        $pathDesc = $targetUploadDesc . "\\" . $pictName;

        $this->meubles->insert($request, $pathDesc);
        return redirect()->back()->with('success_new_meuble', 'Meuble ' . $request->modelType . ': ' . $request->meubleName . ' created success!');
    }

    //mengambil data mebel yang sudah ada untuk field create PO
    public function generateMeubleData()
    {
        if ($_GET["source_url"] == 'salesorder') {
            $meuble = $this->getMeubleByModel($_GET['model']);
        } else {
            $meuble = $this->meubles->findMeubleByModelTypeAndVendor($_GET);
        }

        if (isset($meuble)) {
            return $meuble;
        }

        return json_encode($meuble);
    }

    public function updateStock(Request $request)
    {
        $stock = $this->getMeubleByModel($request['modelType']);
        $stock = $stock->stock;
        $stock += $request['quantity'];
        $this->meubles->update($request, $stock);
    }

    public function updateStockSO(Request $request)
    {
        $stock = $this->getMeubleByModel($request['modelType']);
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
