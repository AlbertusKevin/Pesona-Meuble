@extends('layouts.app')

@section('content')
<div class="container">
    @include('message')
    <h1 class="text-center pt-5 pb-5">Detail of Purchase Order</h1>
    <div class="row">
        <div class="col-12 col-md-6 pb-5">
            <div class="card" style="width: 100%;">
                <div class="card-body pt-4">
                    <h4>Header</h4>
                    <div class="form-group row">
                        <label for="numPO" class="col-sm-4 col-form-label">Num PO:</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control header-field-form" disabled value="{{$po->numPO}}" id="numPO" name="numPO">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="vendor" class="col-sm-4 col-form-label">Vendor:</label>
                        <div class="col-sm-8">
                            <select id="vendor" name="vendor" class="form-control header-field-form">
                                <option value="{{$po->vendor}}">
                                    {{$po->vendor}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="employeeName" class="col-sm-4 col-form-label">Employee Name:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control header-field-form header-field-for" disabled value="{{$employee->id}}:{{$employee->name}}" name="employeeName" id="employeeName">
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
                        <label for="totalItem" class="col-sm-4 col-form-label">Total Item:</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control header-field-form" disabled value="{{$po->totalItem}}" name="totalItem" id="totalItem">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="freightIn" class="col-sm-4 col-form-label">Freight In:</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control header-field-form" value="{{$po->freightIn}}" id="freightIn" name="freightIn">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="totalPrice" class="col-sm-4 col-form-label">Total Price:</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control header-field-form" disabled value="{{$po->totalPrice}}" id="totalPrice" name="totalPrice">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="totalDisc" class="col-sm-4 col-form-label">Total Discount:</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control header-field-form" disabled value="{{$po->totalDiscount}}" id="totalDisc" name="totalDisc">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="totalPayment" class="col-sm-4 col-form-label">Total Payment:</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control header-field-form" disabled value="{{$po->totalPayment}}" id="totalPayment" name="totalPayment">
                        </div>
                    </div>
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
                            <label for="modelType" class="col-sm-4 col-form-label">Model Type:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control header-line-field-form" name="modelType" id="modelType" placeholder="Enter to generate data if exist">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="quantity" class="col-sm-4 col-form-label">Quantity:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control header-line-field-form" id="quantity" name="quantity">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="modelType" class="col-sm-4 col-form-label">Price:</label>
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
                @foreach($line as $item)
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
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class=" row w-100 mh-100 justify-content-end pl-3">
                <button type="button" class="btn btn-secondary updatePost btn-lg" id="createPO">Add</button>
            </div>
        </form>
    </div>
    @endsection