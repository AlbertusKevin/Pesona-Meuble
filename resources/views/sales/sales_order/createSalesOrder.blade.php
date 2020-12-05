{{-- 
    Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
    Unauthorized copying of this file, via any medium is strictly prohibited
    Proprietary and confidential
    Code's Author by Albertus Kevin, Chris Christian, Mikhael Adriel, December 2020 
--}}

@extends('layouts.app')

@section('content')

<div id="employee" data-id="{{$employee->id}}"></div>
<div class="container">
    @include('message')
    <h1 class="text-center pt-5 pb-5">Create Sales Order</h1>
    <div class="row">
        <div class="col-12 col-md-6 pb-5">
            <div class="card" style="width: 100%;">
                <div class="card-body pt-4">
                    <h4>Header</h4>
                    <form id="ajaxCoba">
                        @csrf
                        <div class="form-group row">
                            <label for="numSO" class="col-sm-4 col-form-label">Sales Order Number</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control header-field-form" id="numSO" name="numSO" disabled value="{{$numSO}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer" class="col-sm-4 col-form-label">Customer ID</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="customer" name="customer" placeholder="Customer ID">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Customer Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="customerName" name="customerName" placeholder="Customer Name" disabled value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="employeeName" class="col-sm-4 col-form-label">Employee Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control header-field-form header-field-for" disabled value="{{$employee->id}}: {{$employee->name}}" name="employeeName" id="employeeName">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label">Date</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control header-field-form" id="date" name="date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="validTo" class="col-sm-4 col-form-label">Valid To</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control header-field-form" id="validTo" name="validTo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="totalItem" class="col-sm-4 col-form-label">Total Item</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control header-field-form" disabled value="0" name="totalItem" id="totalItem">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="freightIn" class="col-sm-4 col-form-label">Freight In:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control header-field-form" value="0" id="freightIn" name="freightIn">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="totalPrice" class="col-sm-4 col-form-label">Total Price</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control header-field-form" id="totalPrice" name="totalPrice" disabled value="0">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="paymentDiscount" class="col-sm-4 col-form-label">Discount Payment</label>
                            <div class="col-sm-8">
                                <select id="discount" name="paymentDiscount" id="paymentDiscount" class="form-control header-field-form">
                                    @foreach ($discounts as $discount)
                                    <option value="{{$discount->code}}">
                                        {{$discount->percentDisc}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="totalDisc" class="col-sm-4 col-form-label">Total Discount</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control header-field-form" id="totalDisc" name="totalDisc" disabled value="0">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="totalPayment" class="col-sm-4 col-form-label">Total Payment</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control header-field-form" id="totalPayment" name="totalPayment" disabled value="0">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 pb-5" id="lineHeader">
            <form id="ajaxCoba" action="" method="POST">
                @csrf
                <div class="card" style="width: 100%;">
                    <div class="card-body pt-4">
                        <h4>Line Item</h4>
                        <div class="form-group row">
                            <label for="modelType" class="col-sm-4 col-form-label">Model Type</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control header-line-field-form" name="modelType" id="modelType" placeholder="Model Type">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="meubleName" class="col-sm-4 col-form-label">Meuble Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control header-line-field-form" class="form-control" id="name" name="name" disabled value="" placeholder="Meuble Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="quantity" class="col-sm-4 col-form-label">Quantity</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control header-line-field-form" id="quantity" name="quantity" placeholder="Quantity">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-4 col-form-label">Discount Meuble</label>
                            <div class="col-sm-8">
                                <select id="discountMeuble" name="discountMeuble" class="form-control">
                                    @foreach ($discounts as $discount)
                                    <option value="{{$discount->code}}">{{$discount->code}}: {{$discount->percentDisc}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="modelType" class="col-sm-4 col-form-label">Price</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control header-line-field-form" name="price" id="price" disabled value="0" ;>
                            </div>
                        </div>
                        <div class="row w-100 justify-content-end">
                            <button type="button" class="btn btn-secondary" id="addItem">Add</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class=" row w-100 mh-100 justify-content-end pl-3">
                <button type="button" class="btn btn-secondary updatePost btn-lg" id="newItem" data-toggle="modal" data-target="#formModal">New Customer</button>
            </div>
        </div>
        <div class="col-12 pt-4">
            <h1 class="text-center">Product Lists</h1>
        </div>
        <form id="ajaxInput" action="" method="POST">
            @csrf
            <div class="card" style="width: 100%;" id="lineItem">

            </div>
            <div class=" row w-100 mh-100 justify-content-end pl-3">
                <button type="button" class="btn btn-secondary updatePost btn-lg" id="createTransaction">Add</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="judulModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulModal">Add New Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/customer/create" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card" style="width: 100%;">
                        <div class="card-body pt-4">
                            <h4>Customer's Data</h4>
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-sm-4 col-form-label">Phone</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="phone" name="phone">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-sm-4 col-form-label">Address</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="address" id="address">
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label for="memberId" class="col-sm-4 col-form-label">Member ID</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="memberId" name="memberId">
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="createCustomer">Create New Customer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection