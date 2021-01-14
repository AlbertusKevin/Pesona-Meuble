<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin January 2021
 */

namespace App\Domain\CustomerManagement\Dao;

use App\Http\Controllers\Controller;
use App\Domain\CustomerManagement\Entity\Waranty;
use Illuminate\Http\Request;

class WarrantyDB
{
    public function index()
    {
        return Waranty::all();
    }

    public function store($data, $numSO)
    {
        Waranty::create([
            'numSO' => $numSO,
            'modelType' => $data['item'],
            'responsibleEmployee' => $data['employee'],
            'quantity' => $data['quantity'],
            'description' => $data['info'],
            'status' => 0
        ]);
    }

    public function show($numSO, $modelType)
    {
        return Waranty::where('numSO', $numSO)->where('modelType', $modelType)->first();
    }

    public function get_by_numSO($numSO)
    {
        return Waranty::where('numSO', $numSO)->get();
    }

    public function update($request, $numSO, $modelType)
    {
        Waranty::where('numSO', $numSO)->where('modelType', $modelType)->update([
            'quantity' => $request->quantity,
            'description' => $request->information
        ]);
    }

    public function update_status($numSO, $modelType)
    {
        Waranty::where('numSO', $numSO)->where('modelType', $modelType)->update([
            'status' => 1
        ]);
    }
}
