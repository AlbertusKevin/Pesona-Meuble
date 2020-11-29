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
                            <input type="number" class="form-control header-field-form" disabled value="{{$num}}" id="numPO" name="numPO">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="vendor" class="col-sm-4 col-form-label">Vendor:</label>
                        <div class="col-sm-8">
                            <select id="vendor" name="vendor" class="form-control header-field-form">
                                @foreach ($vendor as $vend)
                                <option value="{{$vend->companyCode}}">
                                    {{$vend->name}}
                                </option>
                                @endforeach
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
                        <label for="totalPrice" class="col-sm-4 col-form-label">Total Price:</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control header-field-form" disabled value="0" id="totalPrice" name="totalPrice">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="totalDisc" class="col-sm-4 col-form-label">Total Discount:</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control header-field-form" disabled value="0" id="totalDisc" name="totalDisc">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="totalPayment" class="col-sm-4 col-form-label">Total Payment:</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control header-field-form" disabled value="0" id="totalPayment" name="totalPayment">
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
            <div class=" row w-100 mh-100 justify-content-end pl-3">
                <button type="button" class="btn btn-secondary updatePost btn-lg" id="newItem" data-toggle="modal" data-target="#formModal">New Item</button>
            </div>
        </div>
        <div class="col-12 pt-4">
            <h1 class="text-center">Product Lists</h1>
        </div>
        <form id="ajaxInput" action="" method="POST">
            @csrf
            <div class="card" style="width: 100%;" id="lineItem">

            </div>
    </div>
    <div class=" row w-100 mh-100 justify-content-end pl-3">
        <button type="button" class="btn btn-secondary updatePost btn-lg" id="createPO">Add</button>
    </div>
    </form>


    <h1 class="text-center pt-5 pb-5">List of Purchase Order</h1>
    <div class="row w-100 justify-content-center">
        <a href="/procurement/create/{{$employee->id}}" type="button" class="btn btn-secondary">Create</a>
    </div>
    <div class="row">
        @if(count($procurement) == 0)
        <div class="col-12 col-md-4 pb-5">
            <div class="card" style="width: 100%;">
                <div class="card-body pl-5 pt-4">
                    <div class="row card-text">
                        <h3 class="font-weight-bold">Tidak Ada Pembelian yang harus diproses</h3>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @foreach($procurement as $po)
        <div class="col-12 col-md-4 pb-5">
            <div class="card" style="width: 100%;">
                <div class="card-body pl-5 pt-4">
                    <div class="row card-text">
                        <h3 class="font-weight-bold">Num: {{$po->numPO}}</h3>
                    </div>
                    <div class="row card-text">
                        <p>{{$po->date}} to {{$po->validTo}}</p>
                    </div>
                    <div class="row pb-3">
                        <p>Vendor: {{$po->vendor}}<br>
                            Person in Charge: {{$employee->name}}<br>
                            Total Item: {{$po->totalItem}}<br>
                            Amount Total: {{$po->totalPrice}}<br>
                            Amount Diskon: {{$po->totalDiscount}}<br>
                            Freight In: {{$po->freightIn}}<br>
                            Total Purchase: {{$po->totalPayment}}
                        </p>
                    </div>
                    <div class="row card-text">
                        <a href="/procurement/detail/{{$employee->id}}/{{$po->numPO}}" class="more">More...</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>

@endsection