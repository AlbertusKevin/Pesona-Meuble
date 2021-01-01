<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\EmployeeAPIController;
use App\Domain\Procurement\Entity\Meuble;

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
    }
    return response()->json([
        'status' => false,
        'message' => 'Data meuble tidak ditemukan.'
    ], 404);
});

Route::get('meubles/{model}', function ($model) {
    $meuble = Meuble::where('modelType', $model)->first();
    if ($meuble) {
        return response()->json([
            'status' => true,
            'meuble' => $meuble,
            'message' => 'Data meuble dengan model ' . $meuble->modelType . ' berhasil didapat.'
        ], 200);
    }
    return response()->json([
        'status' => false,
        'message' => 'Data meuble tidak ditemukan.'
    ], 404);
});
Route::group(['middleware' => 'auth:api'], function () {
});
Route::get('login', 'App\Domain\Employee\Service\Login@login_view');
Route::apiResource('employee', EmployeeAPIController::class);
