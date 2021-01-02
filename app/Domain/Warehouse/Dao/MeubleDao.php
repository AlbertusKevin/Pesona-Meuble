<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 */

namespace App\Domain\Warehouse\Dao;

use App\Http\Controllers\Controller;
use App\Domain\Warehouse\Entity\Meuble;
use App\Domain\Warehouse\Entity\MeubleCategory;
use Illuminate\Http\Request;

class MeubleDao extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */

    public function index_meuble()
    {
        $meubles = Meuble::all();
        return $meubles;
    }

    public static function show_meuble($model)
    {
        return Meuble::where('modelType', $model)->first();
    }

    public static function search_meuble_with_vendor($data)
    {
        return Meuble::where('modelType', $data["model"])->where('vendor', $data["vendor"])->first();
    }

    public function insert($line, $img)
    {
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

    public function update($line, $stock)
    {
        Meuble::where('modelType', $line["modelType"])
            ->update([
                'stock' => $stock
            ]);
    }

    public function showCategory()
    {
        $cat = MeubleCategory::all();
        return $cat;
    }

    public function show_category($id)
    {
        return MeubleCategory::where('id', $id)->first();
    }
}
