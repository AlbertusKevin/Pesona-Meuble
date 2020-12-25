<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Domain\Procurement\Entity\Meuble;
use App\Domain\Employee\Entity\Employee;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('meubles', function () {
    $meubles = Meuble::all();
    if ($meubles) {
        return response()->json([
            'status' => true,
            'meubles' => $meubles,
            'message' => 'Data berhasil didapat.'
        ], 200);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Data meuble tidak ditemukan.'
        ], 404);
    }
});

Route::get('meubles/{model}', function ($model) {
    $meuble = Meuble::where('modelType', $model)->first();
    if ($meuble) {
        return response()->json([
            'status' => true,
            'meuble' => $meuble,
            'message' => 'Data meuble dengan model ' . $meuble->modelType . ' berhasil didapat.'
        ], 200);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Data meuble tidak ditemukan.'
        ], 404);
    }
});


//api untuk data employee
Route::get('employee', function () {
    $employees = Employee::select('name', 'email', 'phone', 'address', 'status')->get();
    if ($employees) {
        return response()->json([
            'status' => 'success',
            'employees' => $employees,
            'message' => 'Berhasil meminta data seluruh pekerja'
        ], 200);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Data pekerja tidak ditemukan.'
        ], 404);
    }
});

Route::get('employee/{id}', function ($id) {
    $employee = Employee::select('name', 'email', 'phone', 'address', 'status')->where('id', $id)->first();
    if ($employee) {
        return response()->json([
            'status' => 'success',
            'employee' => $employee,
            'message' => 'Berhasil meminta data pekerja ' . $employee->name
        ], 200);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Data pekerja tidak ditemukan.'
        ], 404);
    }
});

Route::post('employee', function (Request $request) {
    try {
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
        ], 400);
    }
});

Route::put('employee/{id}', function ($id, Request $request) {
    $employee = Employee::where('id', $id)->update($request->all());
    if ($employee) {
        return response()->json([
            'status' => 'success',
            'employee' => $employee,
            'message' => 'Berhasil mengupdate data pekerja ' . $request->name
        ], 204);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Data pekerja tidak ditemukan.'
        ], 404);
    }
});

Route::delete('employee/{id}', function ($id) {
    $employee = Employee::where('id', $id)->delete();
    if ($employee) {
        return response()->json(null, 204);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Data pekerja tidak ditemukan.'
        ], 404);
    }
});
