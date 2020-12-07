@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="text-center pt-5 pb-5">Create Shipment</h1>
    <div class="row justify-content-center">
        <div class="col-6 pb-5">
            <div class="card" style="width: 100%;">
                <div class="card-body pt-4">
                    <form action="/delivery/new/{{$num}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="shippingPoint" class="col-sm-4 col-form-label">Shipping Point: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="shippingPoint" name="shippingPoint">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="numSO" class="col-sm-4 col-form-label">Sales Order Invoice:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="numSO" name="numSO" value="{{$num}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-4 col-form-label">Status:</label>
                            <div class="col-sm-8">
                                <select id="status" name="status" class="form-control">
                                    <option value="0">Being Delivered</option>
                                    <option value="1">Delivered to Customer</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipDate" class="col-sm-4 col-form-label">Ship Date: </label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="shipDate" name="shipDate">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deliveredDate" class="col-sm-4 col-form-label">Delivered Date:</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="deliveredDate" name="deliveredDate">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Notes" class="col-sm-4 col-form-label">Notes:</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="Notes" name="notes" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <button type="submit" class="btn btn-secondary updatePost">Process</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection