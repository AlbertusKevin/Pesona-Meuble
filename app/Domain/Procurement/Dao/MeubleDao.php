<?php

namespace App\Domain\Procurement\Dao;

use App\Http\Controllers\Controller;
use App\Domain\Procurement\Entity\Meuble;
use Illuminate\Http\Request;

class MeubleService extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */

    public function findAllMeuble(Request $request)
    {
        $meubles = Meuble::all();
        return $meubles; 
    }

    
}
