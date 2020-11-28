<?php

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
        $meubles = Meuble::orderBy('modelType', 'asc')->paginate(2);
        return $meubles;
    }

    public static function findMeubleByModelType($modelType)
    {
        $meuble = Meuble::where('modelType', $modelType)->first();
        return $meuble;
    }

    public function showCategory()
    {
        $cat = MeubleCategory::all();
        return $cat;
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
