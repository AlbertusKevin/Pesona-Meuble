@extends('layouts.app')

@section('content')

<div class="container">
    @include('message')
    <h1 class="text-center pt-5 pb-5">Update Employee's Data</h1>
    <form action='/employee/update/{{$employee->id}}' method="POST">
    @method('PUT')
    @csrf
        <div class="row justify-content-center">
            <div class="col-6 pb-5">
                <div class="card" style="width: 100%;">
                    <div class="card-body pt-4">
                        <h4>Employee's Data</h4>
                        <div class="form-group row">
                            <label for="employeeName" class="col-sm-4 col-form-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="name" value={{$employee->name}}>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Role</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="role" name="role" value={{$employee->role}}>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">E-mail</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="email" value={{$employee->email}}>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Telephone Number</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="phone" name="phone" value={{$employee->phone}}>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Address</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" id="address" name="address">{{$employee->address}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <button type="submit" class="btn btn-secondary buttonPurple">Update Data</button>
        </div>
    </form>
    
</div>

@endsection