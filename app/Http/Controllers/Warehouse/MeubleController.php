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

    public function home_customer()
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

    public function search_meuble()
    {
        if ($_GET["source_url"] == 'salesorder') {
            $meuble = $this->meuble_service->show_meuble($_GET['model']);
        } else {
            $meuble = $this->meuble_service->search_meuble_with_vendor($_GET);
        }

        //todo: untuk dicoba, return langsung meuble tanpa perlu json encode
        if (isset($meuble)) {
            return $meuble;
        }

        return json_encode($meuble);
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
        $request->validate([
            'modelType' => 'required',
            'meubleName' => 'required',
            'category' => 'required',
            'size' => 'required',
            'color' => 'required',
            'description' => 'required',
            'warranty' => 'required',
            'price' => 'required',
            'vendor' => 'required',
            'picture' => 'required'
        ]);

        $this->meuble_service->new_meuble($request);
        return redirect()->back()->with('success_new_meuble', 'Meuble ' . $request->modelType . ': ' . $request->meubleName . ' created success!');
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

    public function add_stock(Request $request)
    {
        $this->meuble_service->add_stock($request);
    }

    public function reduce_stock(Request $request)
    {
        $this->meuble_service->reduce_stock($request);
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
