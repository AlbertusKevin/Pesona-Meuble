<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Procurement\Service\MeubleService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    private $meuble_service;

    public function __construct()
    {
        $this->meuble_service = new MeubleService();
    }

    public function home_view_customer()
    {
        $meubles = $this->meuble_service->index_meuble();
        return view('homecust', [
            'meubles' => $meubles,
        ]);
    }

    public function detail_meuble($typeModel)
    {
        $meuble = $this->meuble_service->show_meuble($typeModel);
        $category = $this->meuble_service->show_category_description($meuble->category);

        return view('customer_service.customer_data.meubleDetail', [
            'meuble' => $meuble,
            'category' => $category
        ]);
    }
}
