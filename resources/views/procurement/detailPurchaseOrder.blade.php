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
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center pt-5 pb-5">Detail of Purchase Order</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 pb-5">
                <div class="card" style="width: 100%;">
                    <div class="card-body pt-4">
                        <h4>Header</h4>
                        <div class="form-group row">
                            <label for="numPO" class="col-sm-4 col-form-label">Num PO:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control header-field-form" disabled
                                    value="{{ $po->numPO }}" id="numPO" name="numPO">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vendor" class="col-sm-4 col-form-label">Vendor:</label>
                            <div class="col-sm-8">
                                <select id="vendor" name="vendor" class="form-control header-field-form" disabled>
                                    <option selected value="{{ $po->vendor }}">
                                        {{ $po->vendor }}
                                    </option>
                                    @foreach ($vendor as $vend)
                                        @if ($vend->companyCode != $po->vendor)
                                            @if ($vend->status != 0)
                                                <option value="{{ $vend->companyCode }}">
                                                    {{ $vend->name }}
                                                </option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="employeeName" class="col-sm-4 col-form-label">Employee Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control header-field-form header-field-for" disabled
                                    value="{{ $employee->id }}:{{ $employee->name }}" name="employeeName" id="employeeName">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label">Date</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control header-field-form" id="date" name="date"
                                    value="{{ $po->date }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="validTo" class="col-sm-4 col-form-label">Valid To</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control header-field-form" id="validTo" name="validTo"
                                    value="{{ $po->validTo }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="totalItem" class="col-sm-4 col-form-label">Total Item:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control header-field-form" disabled
                                    value="{{ $po->totalItem }}" name="totalItem" id="totalItem">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="freightIn" class="col-sm-4 col-form-label">Freight In:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control header-field-form" value="{{ $po->freightIn }}"
                                    id="freightIn" name="freightIn">
                                <input type="hidden" class="form-control" value="{{ $po->freightIn }}" id="oldfreightIn">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="totalPrice" class="col-sm-4 col-form-label">Total Price:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control header-field-form" disabled
                                    value="{{ $po->totalPrice }}" id="totalPrice" name="totalPrice">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="totalDisc" class="col-sm-4 col-form-label">Total Discount:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control header-field-form" value="{{ $po->totalDiscount }}"
                                    id="totalDisc" name="totalDisc">
                                <input type="hidden" class="form-control" value="0" id="oldDiscount">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="totalPayment" class="col-sm-4 col-form-label">Total Payment:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control header-field-form" disabled
                                    value="{{ $po->totalPayment }}" id="totalPayment" name="totalPayment">
                            </div>
                        </div>
                        @if ($po->transactionStatus == 0)
                            <div class="form-group row">
                                <form action="/procurement/cancel/{{ $po->numPO }}" method="Post">
                                    @method('Patch')
                                    @csrf
                                    <div class="col-sm-12">
                                        <button type="button" class="btn btn-success" id="proceed">Proceed</button>
                                        <button type="submit" class="btn btn-danger" id="cancel">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @if ($po->transactionStatus == 0)
                <div class="col-12 col-md-6 pb-5" id="lineHeader">
                    <form id="ajaxCoba" action="" method="POST">
                        @csrf
                        <div class="card" style="width: 100%;">
                            <div class="card-body pt-4">
                                <h4>Line Item</h4>
                                <div class="form-group row">
                                    <label for="modelType" class="col-sm-4 col-form-label">Model Type:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control line-field-form" name="modelType"
                                            id="modelType" placeholder="Enter to generate data if exist">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="quantity" class="col-sm-4 col-form-label">Quantity:</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control line-field-form" id="quantity"
                                            name="quantity">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="modelType" class="col-sm-4 col-form-label">Price:</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control line-field-form" name="price" id="price"
                                            disabled value="0" ;>
                                    </div>
                                </div>
                                <div class="row w-100 justify-content-end">
                                    <button type="button" class="btn btn-secondary" id="addItem">Add</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-12 col-md-12 pt-4">
                <h1 class="text-center">Product Lists</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12">
                <form id="ajaxInput" action="" method="POST">
                    @csrf
                    <div class="card" style="width: 100%;" id="lineItem">
                        @foreach ($line as $item)
                            <div id="{{ $item->modelType }}">
                                <div class="card-body">
                                    <input type="hidden" id="model-{{ $item->modelType }}" value="{{ $item->modelType }}">
                                    <input type="hidden" id="price-{{ $item->modelType }}"
                                        value="{{ $item->buying_price }}">
                                    <input type="hidden" id="quantity-{{ $item->modelType }}" value="{{ $item->quantity }}">
                                    <div class="row pt-3">
                                        <div class="col-12 col-md-3">
                                            <img id="{{ $item->modelType }}-img" class="card-img-top"
                                                src="{{ asset($item->image) }}" alt="Card image cap">
                                        </div>
                                        <div class="col-12 col-md-9 pt-4">
                                            <h3 class="font-weight-bold">{{ $item->modelType }}</h3>Rp
                                            {{ number_format($item->buying_price, 2, ',', '.') }}
                                            <p class="font-weight-bold dataQuantity">Ammount: {{ $item->quantity }}</p>
                                            <p class="font-weight-bold">Color: {{ $item->color }}</p>
                                            <p class="font-weight-bold">Size: {{ $item->size }}</p>
                                            <p class="font-weight-bold">Description: {{ $item->description }}.</p>
                                            @if ($po->transactionStatus == 0)
                                                <button type="button" class="btn btn-primary editItem">edit</button>
                                                <button type="button" class="btn btn-danger removeItem">remove</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($po->transactionStatus == 0)
                        <div class=" row justify-content-end ml-5 mt-5">
                            <button type="button" class="btn btn-secondary updatePost btn-lg"
                                id="updateTransaction">Update</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
