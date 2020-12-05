{{-- 
    Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
    Unauthorized copying of this file, via any medium is strictly prohibited
    Proprietary and confidential
    Code's Author by Chris Christian, December 2020 
--}}

@extends('layouts.app')

@section('content')

<div class="container">
    @include('message')
    <h1 class="text-center pt-5 pb-5">Employee Detail</h1>
        <div class="row justify-content-center">
            <div class="col-6 pb-5">
                <div class="card" style="width: 100%;">
                    <div class="card-body pt-4">
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Employee ID</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold"> : {{$employee->id}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Employee Name</label>
                             <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold"> : {{$employee->name}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Roles </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold"> : {{$employee->role}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Status </label>
                            <div class="col-sm-8">
                                @if($employee->status === 1)
                                    <label class="col-form-label font-weight-bold"> : Hired</label>
                                @else
                                    <label class="col-form-label font-weight-bold"> : Resigned</label>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">E-mail </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold"> : {{$employee->email}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Telephone Number </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold"> : {{$employee->phone}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Raise Iteration </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold"> : {{$employee->raiseIteration}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label"> Salary </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold"> : Rp {{$employee->salary}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @if($employee->status === 1)
                <a href="/employee/update/{{$employee->id}}" type="button" class="btn btn-secondary updatePost">Update Data</a>
                <a href="/employee/raise/{{$employee->id}}" type="button" class="btn btn-secondary updatePost">Raise Salary</a>
                <form action="/employee/resign/{{$employee->id}}" method="POST">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-danger">Resign</button>
                </form>
            @endif
        </div>
</div>

@endsection