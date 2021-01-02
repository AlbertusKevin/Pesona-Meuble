<?php

namespace App\Http\Controllers;

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
        return view('finance.discount.newDiscount', [
            "employee" => $employee,
        ]);
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
            'code' => 'required|min:4|unique:discount',
            'description' => 'required',
            'percentDisc' => 'required',
            'from' => 'required',
            'to' => 'required',
            'discFor' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/discount/create')
                ->withInput()
                ->withErrors($validator);
        }

        $this->discount_service->new_discount($request);
        return redirect('/discount/list')->with(['success' => 'Discount ' . $request->code . 'successfully created !']);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($code)
    {
        $this->discount_service->update_status($code);
        return redirect('/discount/list')->with(['success' => 'Discount ' . $code . ' Updated Expired Successfully !']);
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
        return redirect('/discount/list')->with(['success' => 'Discount ' . $code . ' Deleted !']);
    }
}
