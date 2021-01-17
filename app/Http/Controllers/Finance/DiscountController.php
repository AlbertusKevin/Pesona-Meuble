<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Domain\Employee\Service\EmployeeService;
use App\Domain\Finance\Service\DiscountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{
    private $discount_service;
    private $employee_service;

    public function __construct()
    {
        $this->discount_service = new DiscountService;
        $this->employee_service = new EmployeeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = $this->discount_service->index_discount();
        return view('finance.discount.discountList', compact("discounts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $employee = $this->employee_service->get_employee_by_id($request->session()->get('id_employee'));
        return view('finance.discount.newDiscount', compact('employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|min:4|unique:discount',
            'description' => 'required',
            'percentDisc' => 'required',
            'from' => 'required',
            'to' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/discount/create')
                ->withInput()
                ->withErrors($validator);
        }

        $this->discount_service->new_discount($request);
        return redirect('/discount')->with(['success' => 'Discount ' . $request->code . 'successfully created !']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $discount = $this->discount_service->discount_by_code($code);
        return view('finance.discount.discountDetail', [
            "discount" => $discount,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($code)
    {
        $discount = $this->discount_service->discount_by_code($code);
        return view('finance.discount.updateDiscount', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($code)
    {
        $this->discount_service->update_status($code);
        return redirect('/discount')->with(['success' => 'Discount ' . $code . ' Update Expired Successfully !']);
    }

    public function update_data(Request $request, $code)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'percentDisc' => 'required|numeric|max:2'
        ]);

        if ($validator->fails()) {
            return redirect('/discount/update/' . $code)
                ->withInput()
                ->withErrors($validator);
        }

        $this->discount_service->update_data($request, $code);
        return redirect('/discount')->with(['success' => 'Discount ' . $code . ' Update data Successfully !']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        $this->discount_service->delete_discount($code);
        return redirect('/discount')->with(['success' => 'Discount ' . $code . ' Deleted !']);
    }
}
