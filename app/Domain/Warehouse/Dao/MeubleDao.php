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

    public function insert($request, $img, $price)
    {
        Meuble::create([
            'modelType' => $request->modelType,
            'name' => $request->meubleName,
            'description' => $request->description,
            'price' => $price,
            'category' => (int)$request->category,
            'warantyPeriodeMonth' => (int)$request->warranty,
            'size' => $request->size,
            'stock' => 0,
            'vendor' => $request->vendor,
            'color' => $request->color,
            'image' => $img,
            'status' => 1
        ]);
    }

    public function update($line, $stock)
    {
        Meuble::where('modelType', $line["modelType"])
            ->update([
                'stock' => $stock
            ]);
    }

    public function soft_delete($model, $status)
    {
        Meuble::where('modelType', $model)
            ->update([
                'status' => $status
            ]);
    }

    public function update_data($request, $model, $path)
    {
        Meuble::where('modelType', $model)
            ->update([
                'image' => $path,
                'name' => $request->meubleName,
                'description' => $request->description,
                'category' => $request->category,
                'warantyPeriodeMonth' => $request->warranty,
                'size' => $request->size,
                'vendor' => $request->vendor,
                'color' => $request->color,
                'price' => $request->price
            ]);
    }

    public function index_category()
    {
        return MeubleCategory::all();
    }

    public function show_category($id)
    {
        return MeubleCategory::where('id', $id)->first();
    }
}
