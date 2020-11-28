@extends('layouts.app')

@section('content')
<div id="employee" data-id="{{$employee->id}}"></div>
<div class="container">
    <div class="row justify-content-center">
        @if (session('success_new_meuble'))
        <div class="alert alert-success">
            {{ session('success_new_meuble') }}
        </div>
        @endif
    </div>
    <h1 class="text-center pt-5 pb-5">Create of Purchase Order</h1>
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
            <div class=" row w-100 mh-100 justify-content-end pl-3">
                <button type="button" class="btn btn-secondary updatePost btn-lg" id="createPO">Add</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="judulModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulModal">Add New Meuble</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/procurement/meuble" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card" style="width: 100%;">
                        <div class="card-body pt-4">
                            <h4>Line Item</h4>
                            <div class="form-group row">
                                <label for="modelType" class="col-sm-4 col-form-label">Model Type:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="modelType" id="modelType">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="meubleName" class="col-sm-4 col-form-label">Meuble Name:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="meubleName" name="meubleName">
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
                                <label for="picture" class="col-sm-4 col-form-label">Picture:</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" name="picture" id="picture">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="category" class="col-sm-4 col-form-label">Category:</label>
                                <div class="col-sm-8">
                                    <select id="category" name="category" class="form-control">
                                        @foreach ($category as $cat)
                                        <option value="{{$cat->id}}">
                                            {{$cat->description}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="size" class="col-sm-4 col-form-label">Size:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="size" id="size">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="color" class="col-sm-4 col-form-label">Color:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="color" name="color">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-4 col-form-label">Description:</label>
                                <div class="col-sm-8">
                                    <textarea rows="4" cols="50" class="form-control" name="description" id="description">input Description</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="warranty" class="col-sm-4 col-form-label">Warranty Periode (Month):</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="warranty" id="warranty">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="price" class="col-sm-4 col-form-label">Price:</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="price" id="price">
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="addItem">New Meuble</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection