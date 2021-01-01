{{-- 
    Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
    Unauthorized copying of this file, via any medium is strictly prohibited
    Proprietary and confidential
    Code's Author by Chris Christian, December 2020 
--}}

@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="text-center pt-5 pb-5">Raise Employee Salary</h1>
    <form action='/employee/raise/{{$employee->id}}' method="POST">
        @method('PATCH')
        @csrf
        <div class="row justify-content-center">
            <div class="col-6 pb-5">
                <div class="card" style="width: 100%;">
                    <div class="card-body pt-4">
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Employee ID</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{$employee->id}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Employee Name</label>
                             <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{$employee->name}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Raise Iteration </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{$employee->raiseIteration}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Current Salary </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">Rp {{$employee->salary}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Raise</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="raise" name="raise">
                            </div>
                        </div>
                        <input type="hidden" id="salary" name="salary" value={{$employee->salary}}>
                        <input type="hidden" id="raiseIteration" name="raiseIteration" value={{$employee->raiseIteration}}>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <button type="submit" class="btn btn-secondary buttonPurple">Raise Salary</button>
        </div>
    </form>
</div>

@endsection