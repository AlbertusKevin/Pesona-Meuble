{{--
Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
Unauthorized copying of this file, via any medium is strictly prohibited
Proprietary and confidential
Code's Author by Albertus Kevin, Mikhael Adriel, December 2020
--}}

@extends('layouts.app')

@section('content')
    <div class="container">
        @include('message')
        <div class="row justify-content-center">
            <h1 class="text-center mt-5 mb-5 font-weight-bold">Add New Customer</h1>
        </div>
        <div class="row justify-content-center">
            <div class="card" style="width: 75%;">
                <div class="card-body pt-4">
                    <form action='/customer' method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-3 col-form-label">Phone Number</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="phone" name="phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-secondary buttonPurple">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
