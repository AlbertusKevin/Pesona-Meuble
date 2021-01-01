<?php

namespace App\Http\Controllers\Vendor;

use App\Domain\Vendor\Service\VendorService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    private $vendor_service;

    public function __construct()
    {
        $this->vendor_service = new VendorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = $this->vendor_service->index();
        return view('vendor.vendorList', compact("vendors"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.newVendor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'companyCode' => 'required|unique:vendor',
            'name' => 'required',
            'email' => 'required',
            'telephone' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/vendor/create')
                ->withInput()
                ->withErrors($validator);
        }

        $this->vendor_service->new_vendor($request);
        return redirect('/vendor')->with(['success' => 'New Vendor Addedd Successfully !']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($companyCode)
    {
        $vendor = $this->vendor_service->vendor_by_code($companyCode);
        return view('vendor.vendorDetail', compact("vendor"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor = $this->vendor_service->vendor_by_code($id);
        return view('vendor.updatevendor', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $companyCode)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'telephone' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/vendor/update/' . $companyCode)
                ->withInput()
                ->withErrors($validator);
        }
        $this->vendor_service->update_vendor($request, $companyCode);
        return redirect("/vendor")->with(['success' => 'Vendor ' . $request->name . ' Updated Successfully !']);
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
