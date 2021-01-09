{{--
Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
Unauthorized copying of this file, via any medium is strictly prohibited
Proprietary and confidential
Code's Author by Chris Christian, December 2020
--}}

@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('message')
                <h1 class="text-center pt-5 pb-2 font-weight-bold">Customer Detail</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="width: 100%;">
                    <div class="card-body pt-4">
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Id :</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold"> : {{ $customer->id }}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Name :</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold"> : {{ $customer->name }}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Email :</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold"> : {{ $customer->email }}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Phone :</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold"> : {{ $customer->phone }}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Address :</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold"> : {{ $customer->address }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="/customer/update/{{ $customer->id }}" class="btn btn-primary">Update</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
