@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row pt-2">
        <div class="div col-12 col-md-3 text-right align-self-center mwShipment">Shipment List</div>
        <div class="div col-12 col-md-9 borderShipment">
            <h1>Shipment {{$delivery->deliveryNum}}</h1>
        </div>
    </div>

    <div class="row pt-3">
        <div class="col-6 pb-5">
            <div class="card" style="width: 100%;">
                <div class="card-body pt-4">
                    <form>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Shipping Point: </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{$delivery->shippingPoint}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Sales Order Invoice:</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{$delivery->numSO}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Status:</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">
                                    @if($delivery->status == 0)
                                    Being Delivered
                                    @else
                                    Delivered to Customer
                                    @endif
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Shipment Date: </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{$delivery->dateDelivery}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Delivered Date: </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{$delivery->dateReceived}}</label>
                            </div>
                        </div>
                        @if(isset($delivery->notes))
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Notes: </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{$delivery->notes}}</label>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if($delivery->status == 0)
    <div class="row justify-content-center">
        <form action="/delivery/detail/{{$delivery->deliveryNum}}" method="POST">
            @csrf
            @method('patch')
            <button type="submit" class="btn btn-secondary updatePost">Proceed Status</button>
        </form>
    </div>
    @endif
</div>

@endsection