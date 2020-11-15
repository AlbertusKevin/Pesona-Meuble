@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="text-center pt-5 pb-5">Item Chart List</h1>
    <div class="row">
        <div class="col-12 col-md-6 pb-5">
            <div class="card" style="width: 100%;">
                <div class="card-body pt-4">
                    <h4>Header</h4>
                    <form>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Customer Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Customer Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Customer Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Customer Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Customer Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Customer Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Customer Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Customer Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 pb-5">
            <div class="card" style="width: 100%;">
                <div class="card-body pt-4">
                    <h4>Header</h4>
                    <form>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Customer Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Customer Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Customer Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Customer Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </form>
                    <div class="row w-100 justify-content-end">
                        <button type="button" class="btn btn-secondary">Add</button>
                    </div>
                </div>
            </div>
            <div class="row w-100 mh-100 justify-content-start pl-3">
                <button type="button" class="btn btn-secondary updatePost btn-lg">Update Post</button>
            </div>
        </div>
        <div class="col-12 pt-4">
            <h1 class="text-center">Item Chart List</h1>
        </div>
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <div class="row pt-3">
                    <div class="col-12 col-md-3"><img class="card-img-top" src="{{ asset('images/syntherine.svg') }}" alt="Card image cap"></div>
                    <div class="col-12 col-md-9 pt-4"><h3 class="font-weight-bold">Model Type1</h3>Rp 750.000,00<p class="font-weight-bold">Ammount: 1</p><p class="font-weight-bold">Discount: Rp 100.000,00</p><p class="font-weight-bold">Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam id mi sit amet justo dignissim interdum.</p></div>
                </div>
                <div class="row pt-5">
                    <div class="col-12 col-md-3"><img class="card-img-top" src="{{ asset('images/syntherine.svg') }}" alt="Card image cap"></div>
                    <div class="col-12 col-md-9 pt-4"><h3 class="font-weight-bold">Model Type1</h3>Rp 750.000,00<p class="font-weight-bold">Ammount: 1</p><p class="font-weight-bold">Discount: Rp 100.000,00</p><p class="font-weight-bold">Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam id mi sit amet justo dignissim interdum.</p></div>
                </div>
            </div>
        </div>
        {{-- <div class="row w-100 justify-content-center">
            <a href="#" class="clickShowMore">Click Here Show More</a>
        </div> --}}
    </div>
</div>

@endsection