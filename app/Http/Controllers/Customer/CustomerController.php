<?php

namespace App\Http\Controllers\Customer;

use App\Domain\CustomerManagement\Service\CustomerService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    private $customer_service;

    public function __construct()
    {
        $this->customer_service = new CustomerService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = $this->customer_service->index_customers();
        return view('customer_service.customer_data.customerlist', [
            "customers" => $customers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer_service.customer_data.createCustomer');
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
            'name' => 'required|min:4',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/customer/create')
                ->withInput()
                ->withErrors($validator);
        }

        $this->customer_service->new_customer($request);
        return redirect('/customer')->with(['success' => 'Customer ' . $request->customerName . 'successfully created !']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = $this->customer_service->customer_by_id($id);
        return view('customer_service.customer_data.customerDetail', compact('customer'));
    }

    public function search()
    {
        $customer = $this->customer_service->customer_by_id($_GET['id']);
        if (isset($customer)) {
            return $customer;
        }
        return json_encode($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = $this->customer_service->customer_by_id($id);
        return view('customer_service.customer_data.updatecustomer', [
            "customers" => $customers
        ]);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/customer/update/' . $id)
                ->withInput()
                ->withErrors($validator);
        }
        $this->customer_service->update($request, $id);
        return redirect('/customer')->with(['success' => 'Customer ' . $request->name . ' Updated Successfully !']);
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
