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

    public static function findAllMeubles()
    {
        $meubles = Meuble::orderBy('modelType', 'asc')->paginate(2);
        return $meubles;
    }

    public static function findMeubleByModelType($modelType)
    {
        $meuble = Meuble::where('modelType', '=', $modelType)->first();
        return $meuble;
    }

    public function showCategory()
    {
        $cat = MeubleCategory::all();
        return $cat;
    }
}
