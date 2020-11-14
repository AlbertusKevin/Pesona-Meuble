@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row pt-2">
        <div class="div col-12 col-md-3 text-right align-self-center mwShipment">Shipment List</div>
        <div class="div col-12 col-md-9 borderShipment"><h1>Shipment Invoice SH-001</h1></div>
    </div>

    <div class="row pt-3">
        <div class="col-6 pb-5">
            <div class="card" style="width: 100%;">
                <div class="card-body pt-4">
                    <form>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Shipping Point: </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">??</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Shipment Invoice:</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">SH-001</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Sales Order Invoice:</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">SH-001</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Status:</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">Delivered to Customer</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Ship Date: </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">22/10/2020</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Estimated Deliver Date: </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">25/10/2020</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Delivered Date: </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">26/10/2020</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Destination Address: </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">ABC Street 123, Bandung</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Notes: </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">This is notes for shipment</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--  <div class="row justify-content-center">
        <button type="button" class="btn btn-secondary updatePost">Add</button>
    </div>  --}}
</div>

@endsection