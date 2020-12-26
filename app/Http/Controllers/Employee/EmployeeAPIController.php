<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Employee\Entity\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Throwable;

class EmployeeAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::select('name', 'email', 'phone', 'address', 'status')->get();
        if ($employees) {
            return response()->json([
                'status' => 'success',
                'employees' => $employees,
                'message' => 'Berhasil meminta data seluruh pekerja'
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Data pekerja tidak ditemukan.'
        ], 404);
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
        try {
            $rules = [
                'name' => 'required',
                'email' => 'email|required',
                'phone' => 'required|number',
                'address' => 'required',
                'password' => 'required|min:6',
                'role' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors,
                ], 400);
            }

            $employee = Employee::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'raiseIteration' => 0,
                'status' => 1,
                'salary' => 3500000
            ]);

            return response()->json([
                'status' => 'success',
                'employee' => $employee,
                'message' => 'Berhasil menambah data pekerja ' . $request->name
            ], 201);
        } catch (Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menambahkan data karyawan.',
                'error' => $e
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::select('name', 'email', 'phone', 'address', 'status')->where('id', $id)->first();
        if ($employee) {
            return response()->json([
                'status' => 'success',
                'employee' => $employee,
                'message' => 'Berhasil meminta data pekerja ' . $employee->name
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Data pekerja tidak ditemukan.'
        ], 404);
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
        $employee = Employee::where('id', $id)->update($request->all());
        if ($employee) {
            return response()->json([
                'status' => 'success',
                'employee' => $employee,
                'message' => 'Berhasil mengupdate data pekerja ' . $request->name
            ], 204);
        }
        return response()->json([
            'status' => false,
            'message' => 'Data pekerja tidak ditemukan.'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::where('id', $id)->delete();
        if ($employee) {
            return response()->json(null, 204);
        }
        return response()->json([
            'status' => false,
            'message' => 'Data pekerja tidak ditemukan.'
        ], 404);
    }
}
