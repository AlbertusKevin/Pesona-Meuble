{{-- 
    Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
    Unauthorized copying of this file, via any medium is strictly prohibited
    Proprietary and confidential
    Code's Author by Chris Christian, Mikhael Adriel, December 2020 
--}}

@extends('layouts.app')

@section('content')

<div class="container">
    @include('message')
    <h1 class="text-center pt-5 pb-5">New Discount</h1>
    <div class="row justify-content-center">
        <div class="col-6 pb-5">
            <div class="card" style="width: 100%;">
                <div class="card-body pt-4">
                    <form action='/discount/create' method="POST">
                        @csrf 
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Discount Code</label>
                            <div class="col-sm-8">
                                <input type="text" id='code' name='code' class="form-control" placeholder='Discount Code'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Description</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="exampleFormControlTextarea1" name='description' rows="3" placeholder='Description'></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Responsible Employee</label>
                            <div class="col-sm-8">
                                <input type="text" id='responsibleEmployee' name='responsibleEmployee' class="form-control" value='{{$employee->name}}' disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Discount (%)</label>
                            <div class="col-sm-8">
                                <input type="number" id='percentDisc' name='percentDisc' class="form-control" placeholder='Discount'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Valid From</label>
                            <div class="col-sm-8">
                                <input type="date" id='from' name='from'class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Valid To</label>
                            <div class="col-sm-8">
                                <input type="date" id='to' name='to'class="form-control">
                            </div>
                        </div>
                        <input type="hidden" id='employeeID' name='employeeID' value="{{$employee->id}}">
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-secondary buttonPurple">Add New Discount</button>
                        </div>
                    </form>    
                </div>
            </div>
            
        </div>
    </div>
   {{--   <div class="row justify-content-center">
        <button type="button" class="btn btn-secondary updatePost">Edit</button>
    </div>
    <div class="row justify-content-center pt-3">
        <a href="#" class="more">Back</a>
    </div>  --}}
</div>
</div>

@endsection