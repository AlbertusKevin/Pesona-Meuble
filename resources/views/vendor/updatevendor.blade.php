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
    <div class="row justify-content-center">
        <h1 class="text-center mt-5 mb-5 font-weight-bold">Update Vendor</h1>
    </div>
    <div class="row justify-content-center">
        <div class="card p-5" style="width: 75%;">
            <div class="card-body pt-4">
                <form action="/vendor/update/{{$vendor->companyCode}}" method="POST">

                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label for="customerName" class="col-sm-3 col-form-label">Name:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" value="{{$vendor->name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customerName" class="col-sm-3 col-form-label">Email:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="email" name="email" value="{{$vendor->email}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customerName" class="col-sm-3 col-form-label">Phone Number:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="telephone" name="telephone" value="{{$vendor->telephone}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customerName" class="col-sm-3 col-form-label">Address:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="address" name="address" value="{{$vendor->address}}">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-secondary buttonPurple">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection