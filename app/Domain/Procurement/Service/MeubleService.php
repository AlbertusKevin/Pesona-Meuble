<?php

namespace App\Domain\Procurement\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Procurement\Dao\ProcurementDB;
use App\Domain\Employee\Dao\EmployeeDB;
use App\Domain\Procurement\Dao\MeubleDao;
use App\Domain\Vendor\Dao\VendorDB;

class MeubleService extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */
    private $meubles;

    public function __construct()
    {
        $this->meubles = new MeubleDao();
    }

    public function homeView() 
    { 
        $meubles = $this->meubles->findAllMeubles(); 
        return view('home', [
            'meubles' => $meubles,
        ]);
    }
}
