<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 */

namespace App\Domain\Procurement\Dao;

use App\Http\Controllers\Controller;
use App\Domain\Procurement\Entity\Meuble;
use App\Domain\Procurement\Entity\MeubleCategory;
use Illuminate\Http\Request;

class MeubleDao extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */

    public function findAllMeubles()
    {
        $meubles = Meuble::orderBy('modelType', 'asc')->get();
        return $meubles;
    }

    public static function findMeubleByModelType($model)
    {
        $meuble = Meuble::where('modelType', $model)->first();
        return $meuble;
    }

    public static function findMeubleByModelTypeAndVendor($data)
    {
        $meuble = Meuble::where('modelType', $data["model"])->where('vendor', $data["vendor"])->first();
        return $meuble;
    }

    public function showCategory()
    {
        $cat = MeubleCategory::all();
        return $cat;
    }

    public function getCategoryDescription($id)
    {
        return MeubleCategory::where('id', $id)->first();
    }

    //input mebel baru yang dibeli lewat proses PO
    public function insert($line, $img)
    {
        // modelType, meubleName, category, size, color, description, warranty, price, quantity, vendor
        // modelType 	image 	name 	description 	price 	category 	warantyPeriodeMonth 	size 	stock 	vendor 	color 	
        Meuble::create([
            'modelType' => $line["modelType"],
            'name' => $line["meubleName"],
            'description' => $line["description"],
            'price' => (int)$line["price"],
            'category' => (int)$line["category"],
            'warantyPeriodeMonth' => (int)$line["warranty"],
            'size' => $line["size"],
            'stock' => 0,
            'vendor' => $line["vendor"],
            'color' => $line["color"],
            'image' => $img
        ]);
    }

    //update stok barang jika barang yang dibeli sudah ada di mebel db
    public function update($line, $stock)
    {
        Meuble::where('modelType', $line["modelType"])
            ->update([
                'stock' => $stock
            ]);
    }
}
