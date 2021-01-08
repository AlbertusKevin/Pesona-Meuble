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
use Illuminate\Support\Facades\File;

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

    private function upload_image($img, $category)
    {
        //upload file ke folder yang disediakan
        $pictName = $img->getClientOriginalName();
        //ambil ekstensi file
        $pictName = explode('.', $pictName);
        //buat nama baru yang unique
        $pictName = uniqid() . '.' . end($pictName);
        $targetUploadDesc = "images\\sales\\meuble\\" . $category;
        $img->move($targetUploadDesc, $pictName);

        return $targetUploadDesc . "\\" . $pictName;   //membuat file path yang akan digunakan sebagai src html
    }

    public function new_meuble($request)
    {
        $category = $this->meubles->show_category($request->category);
        $category = $category->description;
        $pathDesc = $this->upload_image($request->file('picture'), $category);
        $this->meubles->insert($request, $pathDesc);
    }

    public function soft_delete($model, $status)
    {
        $this->meubles->soft_delete($model, $status);
    }

    public function update_meuble($request, $model)
    {
        $pictPath = $this->meubles->show_meuble($model);
        $pictPath = $pictPath->image;

        if ($request->file('picture') !== null) {
            // hapus file yang lama
            if (File::exists(public_path($pictPath))) {
                File::delete(public_path($pictPath));
            }

            $category = $this->meubles->show_category($request->category);
            $category = $category->description;
            $pictPath = $this->upload_image($request->file('picture'), $category);
        }

        $this->meubles->update_data($request, $model, $pictPath);
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

    public function index_category()
    {
        return $this->meubles->index_category();
    }
}
