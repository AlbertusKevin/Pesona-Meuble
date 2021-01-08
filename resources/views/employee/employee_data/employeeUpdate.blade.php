{{--
Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
Unauthorized copying of this file, via any medium is strictly prohibited
Proprietary and confidential
Code's Author by Chris Christian, December 2020
--}}

@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @include('message')
            </div>
        </div>
        <h1 class="text-center pt-5 pb-5">Update Data</h1>
        <form action='/employee/{{ $employee->id }}' method="POST">
            @method('PATCH')
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="employeeName" class="col-sm-4 col-form-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="name" name="name"
                                        value={{ $employee->name }}>
                                </div>
                            </div>
                            @if ($employee->role != 'owner')
                                <div class="form-group row">
                                    <label for="role" class="col-sm-4 col-form-label">Role</label>
                                    <div class="col-sm-8">
                                        <select id="role" name="role" class="form-control">
                                            <option selected value="{{ $employee->role }}">{{ $employee->role }}</option>
                                            <option value="sales">sales</option>
                                            <option value="inventory">inventory</option>
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">E-mail</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="email" name="email"
                                        value={{ $employee->email }}>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="customerName" class="col-sm-4 col-form-label">Telephone Number</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value={{ $employee->phone }}>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="customerName" class="col-sm-4 col-form-label">Address</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" id="address"
                                        name="address">{{ $employee->address }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn buttonPurple">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

@endsection
