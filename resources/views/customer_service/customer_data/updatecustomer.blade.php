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
            <div class="col-md-12">
                <h1 class="text-center mt-5 mb-5 font-weight-bold">Update Customer</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-2 pt-4" style="width: 100%;">
                    <form action='/customer/update/{{ $customers->id }}' method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="card-body pt-4">
                            <div class="form-group row">
                                <label for="customerName" class="col-md-3 offset-md-1 col-form-label">Name:</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $customers->name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="customerName" class="col-md-3 offset-md-1 col-form-label">Email:</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="email" name="email"
                                        value="{{ $customers->email }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="customerName" class="col-md-3 offset-md-1 col-form-label">Phone Number:</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ $customers->phone }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="customerName" class="col-md-3 offset-md-1 col-form-label">Address:</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="{{ $customers->address }}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary buttonPurple">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
