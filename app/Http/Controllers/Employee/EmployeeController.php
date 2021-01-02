<?php

namespace App\Http\Controllers\Employee;

use App\Domain\Employee\Service\EmployeeService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    private $employee_service;

    public function __construct()
    {
        $this->employee_service = new EmployeeService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->employee_service->index_employee();
        return view('employee.employee_data.employeeList', [
            'employees' => $employees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.employee_data.newEmployee');
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
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
            'role' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/employee/create')
                ->withInput()
                ->withErrors($validator);
        }

        $this->employee_service->store($request);
        return redirect('/employee')->with(['success' => 'New Employee Addedd Successfully !']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = $this->employee_service->get_employee_by_id($id);
        return view('employee.employee_data.employeeDetail', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = $this->employee_service->get_employee_by_id($id);
        return view('employee.employee_data.employeeUpdate', [
            'employee' => $employee,
        ]);
    }

    public function edit_salary($id)
    {
        $employee = $this->employee_service->get_employee_by_id($id);
        return view('employee.employee_data.employeeRaiseSalary', [
            'employee' => $employee,
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
            'role' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/employee/update/' . $id)
                ->withInput()
                ->withErrors($validator);
        }

        $this->employee_service->update_employee($request, $id);
        return redirect('/employee')->with(['success' => 'Employee ' . $request->name . ' Updated Successfully !']);
    }

    public function update_active_status(Request $request, $id)
    {
        $this->employee_service->resign($id);
        return redirect('/employee')->with(['success' => 'Employee ' . $request->name . ' has been resigned !']);
    }

    public function update_salary(Request $request, $id)
    {
        $this->employee_service->update_salary($request, $id);
        return redirect('/employee')->with(['success' => 'Employee ' . $request->name . ' salary has been raised successfully!']);
    }
}
