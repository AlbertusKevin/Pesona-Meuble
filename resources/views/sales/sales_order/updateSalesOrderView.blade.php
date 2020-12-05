{{-- 
    Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
    Unauthorized copying of this file, via any medium is strictly prohibited
    Proprietary and confidential
    Code's Author by Albertus Kevin, Chris Christian, Mikhael Adriel, December 2020 
--}}

@extends('layouts.app')

@section('content')
<div class="container">
    @include('message')
    <h1 class="text-center pt-5 pb-5">Detail of Open Sales Order</h1>
    <div class="row">
        <div class="col-12 col-md-6 pb-5">
            <div class="card" style="width: 100%;">
                <div class="card-body pt-4">
                    <h4>Header</h4>
                    <div class="form-group row">
                        <label for="numSO" class="col-sm-4 col-form-label">Sales Order Number</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control header-field-form" id="numSO" name="numSO" disabled value="{{$salesorder->numSO}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customer" class="col-sm-4 col-form-label">Customer ID</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="customer" name="customer" placeholder="Customer ID" disabled value="{{$salesorder->customer}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customerName" class="col-sm-4 col-form-label">Customer Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="customerName" name="customerName" placeholder="Customer Name" disabled value="{{$salesorder->name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="employeeName" class="col-sm-4 col-form-label">Employee Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control header-field-form header-field-for" disabled value="{{$salesorder->responsibleEmployee}}" name="employeeName" id="employeeName">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-4 col-form-label">Date</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control header-field-form" id="date" name="date" disabled value="{{$salesorder->date}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="validTo" class="col-sm-4 col-form-label">Valid To</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control header-field-form" id="validTo" name="validTo" disabled value="{{$salesorder->validTo}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="totalItem" class="col-sm-4 col-form-label">Total Item</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control header-field-form" disabled name="totalItem" id="totalItem" disabled value="{{$salesorder->totalItem}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="freightIn" class="col-sm-4 col-form-label">Freight In:</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control header-field-form" disabled value="{{$salesorder->freightIn}}" id="freightIn" name="freightIn">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="totalPrice" class="col-sm-4 col-form-label">Total Price</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control header-field-form" id="totalPrice" name="totalPrice" disabled value="{{$salesorder->totalPrice}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="paymentDiscount" class="col-sm-4 col-form-label">Discount Payment</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control header-field-form header-field-for" disabled value="{{$salesorder->paymentDiscount}}" name="paymentDiscount" id="paymentDiscount">
                            {{-- <select id="discount" name="paymentDiscount" id="paymentDiscount" class="form-control header-field-form" >
                                    @foreach ($discounts as $discount)
                                        <option value="{{$discount->code}}">
                            {{$discount->code}}
                            </option>
                            @endforeach
                            </select> --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="totalDisc" class="col-sm-4 col-form-label">Total Discount</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control header-field-form" id="totalDisc" name="totalDisc" disabled value="{{$salesorder->totalDiscount}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="totalPayment" class="col-sm-4 col-form-label">Total Payment</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control header-field-form" id="totalPayment" name="totalPayment" disabled value="{{$salesorder->totalPayment}}">
                        </div>
                    </div>
                    <form action="/salesorder/cancel/{{$salesorder->numSO}}" method="Post">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-8">
                                <button type="button" class="btn btn-success" id="proceed">Proceed</button>
                                <button type="submit" class="btn btn-danger" id="cancel">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if($salesorder->transactionStatus === 0)
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
                        {{-- <div class="form-group row">
                                <label for="price" class="col-sm-4 col-form-label">Discount Meuble</label>
                                <div class="col-sm-8">
                                    <select id="discountMeuble" name="discountMeuble" class="form-control">
                                        @foreach ($discounts as $discount)
                                            <option value="{{$discount->code}}">
                        {{$discount->code}}
                        </option>
                        @endforeach
                        </select>
                    </div>
                </div> --}}
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
</div>
<div class="col-12 pt-4">
    <h1 class="text-center">Product Lists</h1>
</div>
<form id="ajaxInput" action="" method="POST">
    @csrf
    <div class="card" style="width: 100%;" id="lineItem">
        @foreach($salesorderlines as $item)
        <div id="{{$item->modelType}}" data-model="{{$item->modelType}}" data-meubleName="{{$item->name}}" data-price="{{$item->price}}" data-quantity="{{$item->quantity}}" data-category="{{$item->category}}" data-warranty="{{$item->warrantyPeriodeMonth}}" data-color="{{$item->color}}" data-size="{{$item->size}}" data-description="{{$item->description}}">
            <div class="row pt-3">
                <div class="col-12 col-md-3">
                    <img id="{{$item->modelType}}-img" class="card-img-top" src="{{ asset($item->image) }}" alt="Card image cap">
                </div>
                <div class="col-12 col-md-9 pt-4">
                    <h3 class="font-weight-bold">{{$item->modelType}}</h3>Rp {{$item->price}},00
                    <p class="font-weight-bold">Ammount: {{$item->quantity}}</p>
                    <p class="font-weight-bold">Color: {{$item->color}}</p>
                    <p class="font-weight-bold">Size: {{$item->size}}</p>
                    <p class="font-weight-bold">Description: {{$item->description}}.</p>
                    <button type="button" class="btn btn-primary editItem" id="editItem">edit</button>
                    <button type="button" class="btn btn-danger removeItem" id="removeItem">remove</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class=" row w-100 mh-100 justify-content-end pl-3">
        <button type="button" class="btn btn-secondary updatePost btn-lg" id="updateSO">Update Sales Order</button>
    </div>
</form>
@else
@if(count($salesorderlines) > 0)
<div class="col-12 pt-4">
    <h1 class="text-center">Product Lists</h1>
</div>
<div class="card" style="width: 100%;">
    @foreach($salesorderlines as $item)
    <div id="{{$item->modelType}}">
        <input type="hidden" id="model-{{$item->modelType}}" value="{{$item->modelType}}">
        <input type="hidden" id="name-{{$item->modelType}}" value="{{$item->name}}">
        <input type="hidden" id="price-{{$item->modelType}}" value="{{$item->price}}">
        <input type="hidden" id="quantity-{{$item->modelType}}" value="{{$item->quantity}}">
        <input type="hidden" id="category-{{$item->modelType}}" value="{{$item->category}}">
        <input type="hidden" id="warranty-{{$item->modelType}}" value="{{$item->warrantyPeriodeMonth}}">
        <input type="hidden" id="color-{{$item->modelType}}" value="{{$item->color}}">
        <input type="hidden" id="size-{{$item->modelType}}" value="{{$item->size}}">
        <input type="hidden" id="desc-{{$item->modelType}}" value="{{$item->description}}">
        <input type="hidden" id="discMeuble-{{$item->modelType}}" value="${{$item->discountMeuble}}">
        <div class="row pt-3">
            <div class="col-12 col-md-3">
                <img id="{{$item->modelType}}-img" class="card-img-top" src="{{ asset($item->image) }}" alt="Card image cap">
            </div>
            <div class="col-12 col-md-9 pt-4">
                <h3 class="font-weight-bold">{{$item->modelType}}</h3>Rp {{$item->price}},00
                <p class="font-weight-bold">Ammount: {{$item->quantity}}</p>
                <p class="font-weight-bold">Color: {{$item->color}}</p>
                <p class="font-weight-bold">Size: {{$item->size}}</p>
                <p class="font-weight-bold">Description: {{$item->description}}.</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="col-12 col-md-6 pb-5">
    <div class="card" style="width: 100%;">
        <div class="card-body pt-4">
            <h4>No Item Lines in This Sales Order.</h4>
        </div>
    </div>
</div>
@endif
@endif
</div>
</div>

@endsection