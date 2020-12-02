@extends('layouts.app')

@section('content')

<div class="container">
    @include('message')
    <h1 class="text-center pt-5 pb-5">Add New Vendor</h1>
    <form action='/vendor/create' method="POST">
        @csrf
        <div class="row justify-content-center">
            <div class="col-6 pb-5">
                <div class="card" style="width: 100%;">
                    <div class="card-body pt-4">
                        <h4>Vendor's Data</h4>
                        <div class="form-group row">
                            <label for="companyCode" class="col-sm-4 col-form-label">Company Code</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="companyCode" name="companyCode">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Vendor Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">E-mail</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Telephone Number</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="telephone" name="telephone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Address</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" id="address" name="address"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <button type="submit" class="btn btn-secondary buttonPurple">Add New Vendor</button>
        </div>
    </form>
    
</div>

@endsection