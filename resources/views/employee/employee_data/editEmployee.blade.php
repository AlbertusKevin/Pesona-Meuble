{{-- 
    Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
    Unauthorized copying of this file, via any medium is strictly prohibited
    Proprietary and confidential
    Code's Author by Chris Christian, December 2020 
--}}

@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="text-center pt-5 pb-5">Edit Employee</h1>
    <div class="row justify-content-center">
        <div class="col-6 pb-5">
            <div class="card" style="width: 100%;">
                <div class="card-body pt-4">
                    <h4>Header</h4>
                    <form>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Employee ID: </label>
                            <div class="col-sm-8">
                                <label class="col-sm-4 col-form-label font-weight-bold">EM-001</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Employee Name:</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold pl-3">Joko Nugraha</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Roles:</label>
                            <div class="col-sm-8">
                                <label class="col-sm-4 col-form-label font-weight-bold">Sales</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">E-mail:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Telephone Number: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Alamat:</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Gaji Awal: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <button type="button" class="btn btn-secondary buttonPurple">Add</button>
    </div>
</div>

@endsection