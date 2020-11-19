@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="text-center pt-5 pb-5">Create Sales Order</h1>
    <div class="row">
        <div class="col-12 col-md-6 pb-5">
            <div class="card" style="width: 100%;">
                <div class="card-body pt-4">
                    <h4>Header</h4>
                    <form action="/salesorder" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="numSO" class="col-sm-4 col-form-label">Sales Order Number</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="numSO" name="numSO" placeholder="Sales Order Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer" class="col-sm-4 col-form-label">Customer Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="customer" name="customer" placeholder="Customer Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="employee" class="col-sm-4 col-form-label">Employee Name</label>
                            <div class="col-sm-8">
                                <select id="employee" name="employee" class="form-control">
                                    @foreach ($employees as $employee)
                                        <option value="{{$employee->name}}">
                                            {{$employee->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label">Date</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control"  id="date" name="date" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="validTo" class="col-sm-4 col-form-label">Valid To</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="validTo" name="validTo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="totalItem" class="col-sm-4 col-form-label">Total Item</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="totalItem" name="totalItem"
                                    placeholder="Total Item">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="totalPrice" class="col-sm-4 col-form-label">Total Price</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="totalPrice" name="totalPrice"
                                    placeholder="Total Price">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="paymentDiscount" class="col-sm-4 col-form-label">Discount Payment</label>
                            <div class="col-sm-8">
                                <select id="discount" name="paymentDiscount" class="form-control">
                                    @foreach ($discounts as $discount)
                                        <option value="{{$discount->code}}">
                                            {{$discount->code}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="totalDiscount" class="col-sm-4 col-form-label">Total Discount</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="totalDiscount" name="totalDiscount"
                                    placeholder="Total Discount">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="totalPayment" class="col-sm-4 col-form-label">Total Payment</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="totalPayment" name="totalPayment"
                                    placeholder="totalPayment">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 pb-5">
            <div class="card" style="width: 100%;">
                <div class="card-body pt-4">
                    <h4>Line Item</h4>
                    <form>
                        <div class="form-group row">
                            <label for="modelType" class="col-sm-4 col-form-label">Model Type</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="modelType" name="modelType" 
                                    placeholder="Model Type">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="meubleName" class="col-sm-4 col-form-label">Meuble Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" class="form-control" id="name" name="name" 
                                    placeholder="Model Name" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="quantity" class="col-sm-4 col-form-label">Quantity</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="quantity" name="quantity" 
                                placeholder="Quantity">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-4 col-form-label">Price</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="price" name="prie" 
                                placeholder="Price">
                            </div>
                        </div>
                        <div class="form-group row">
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
                        </div>
                    </form>
                    <div class="row w-100 justify-content-end">
                        <button type="button" class="btn btn-secondary">Add</button>
                    </div>
                </div>
            </div>
            <div class="row w-100 mh-100 justify-content-start pl-3">
                <button type="button" class="btn btn-secondary updatePost btn-lg" type="ubmit">Add Sales Order</button>
            </div>
        </div>
        <div class="col-12 pt-4">
            <h1 class="text-center">Product Lists</h1>
        </div>
        <div class="card" style="width: 100%;">
            @if(count($meubles) > 0)
                <div class="card-body">
                    @foreach($meubles as $meuble)
                        <div class="row pt-4">
                            <div class="col-12 col-md-3"><img class="card-img-top" src="{{ asset('images/syntherine.svg') }}" alt="Card image cap"></div>
                            <div class="col-12 col-md-9 pt-4"><h3 class="font-weight-bold">{{$meuble->modelType}}</h3>{{$meuble->price}}<p class="font-weight-bold">Ammount: 1</p><p class="font-weight-bold">Discount: Rp 100.000,00</p><p class="font-weight-bold">Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam id mi sit amet justo dignissim interdum.</p></div>
                        </div>  
                    @endforeach
                </div>
            @else 
                <div class="row w-100 justify-content-center">
                    <h3>No Sales Order Found</h3>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection