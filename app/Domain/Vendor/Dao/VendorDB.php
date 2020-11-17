<?php

namespace App\Domain\Vendor\Dao;

use App\Http\Controllers\Controller;
use App\Domain\Vendor\Entity\Vendor;

class VendorDB extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */

    public static function showAll()
    {
        $vend = Vendor::all();
        return $vend;
    }
}
