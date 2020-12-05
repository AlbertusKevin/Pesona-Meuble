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
    <h1 class="text-center pt-5 pb-5">Vendor Detail</h1>
        <div class="row justify-content-center">
            <div class="col-6 pb-5">
                <div class="card" style="width: 100%;">
                    <div class="card-body pt-4">
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Company Code</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold"> : {{$vendor->companyCode}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Vendor Name</label>
                             <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold"> : {{$vendor->name}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Email </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold"> : {{$vendor->email}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Telephone </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold"> : {{$vendor->telephone}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Address </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold"> : {{$vendor->address}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <a href="/vendor/update/{{$vendor->CompanyCode}}" type="button" class="btn btn-secondary updatePost">Update Data</a>
        </div>
</div>

@endsection