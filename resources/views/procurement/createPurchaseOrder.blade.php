@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="text-center pt-5 pb-5">Create of Purchase Order</h1>
    <div class="row">
        <div class="col-12 col-md-6 pb-5">
            <div class="card" style="width: 100%;">
                <div class="card-body pt-4">
                    <h4>Header</h4>
                    <form>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Num PO:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" disabled value="10000001">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Vendor:</label>
                            <div class="col-sm-8">
                                <select id="employee" name="employee" class="form-control">
                                    @foreach ($vendor as $vend)
                                    <option value="{{$vend->companyCode}}">
                                        {{$vend->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Employee Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" disabled value="{{$employee->name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label">Date</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="date" name="date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="validTo" class="col-sm-4 col-form-label">Valid To</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="validTo" name="validTo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Total Item:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" disabled value="0">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Freight In:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" value="0">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Total Price:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" disabled value="0">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Total Discount:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" disabled value="0">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Total Payment:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" disabled value="0">
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
                            <label for="customerName" class="col-sm-4 col-form-label">Model Type:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Meuble Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Category:</label>
                            <div class="col-sm-8">
                                <select id="employee" name="employee" class="form-control">
                                    @foreach ($category as $cat)
                                    <option value="{{$vend->companyCode}}">
                                        {{$cat->description}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Size:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Color:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Image:</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Description:</label>
                            <div class="col-sm-8">
                                <textarea rows="4" cols="50" class="form-control">input Description</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Warranty Periode (Month):</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Price:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Quantity:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control">
                            </div>
                        </div>
                    </form>
                    <div class="row w-100 justify-content-end">
                        <button type="button" class="btn btn-secondary" onclick="onclick()">Add</button>
                    </div>
                </div>
            </div>
            <div class=" row w-100 mh-100 justify-content-start pl-3">
                <button type="button" class="btn btn-secondary updatePost btn-lg">Update Post</button>
            </div>
        </div>
        <div class="col-12 pt-4">
            <h1 class="text-center">Product Lists</h1>
        </div>
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <div class="row pt-3">
                    <div class="col-12 col-md-3"><img class="card-img-top" src="{{ asset('images/syntherine.svg') }}" alt="Card image cap"></div>
                    <div class="col-12 col-md-9 pt-4">
                        <h3 class="font-weight-bold">Model Type1</h3>Rp 750.000,00<p class="font-weight-bold">Ammount: 1</p>
                        <p class="font-weight-bold">Discount: Rp 100.000,00</p>
                        <p class="font-weight-bold">Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam id mi sit amet justo dignissim interdum.</p>
                    </div>
                </div>
                <div class="row pt-5">
                    <div class="col-12 col-md-3"><img class="card-img-top" src="{{ asset('images/syntherine.svg') }}" alt="Card image cap"></div>
                    <div class="col-12 col-md-9 pt-4">
                        <h3 class="font-weight-bold">Model Type1</h3>Rp 750.000,00<p class="font-weight-bold">Ammount: 1</p>
                        <p class="font-weight-bold">Discount: Rp 100.000,00</p>
                        <p class="font-weight-bold">Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam id mi sit amet justo dignissim interdum.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection