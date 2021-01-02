<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Warehouse\Service\MeubleService;

class MeubleController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
