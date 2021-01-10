@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row pt-2 ">
            <div class="col-md-2 offset-md-3 text-right align-self-center">Shipment Detail</div>
            <div class="col-md-6 borderShipment">
                <h1>Document Shipment {{ $delivery->deliveryNum }}</h1>
            </div>
        </div>

        <div class="row pt-3">
            <div class="col-md-6 offset-md-3 pb-5">
                <div class="card" style="width: 100%;">
                    <div class="card-body pt-4">
                        <form>
                            <div class="form-group row">
                                <label for="customerName" class="col-sm-4 col-form-label">Shipping Point: </label>
                                <div class="col-sm-8">
                                    <label class="col-form-label font-weight-bold">{{ $delivery->shippingPoint }}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="customerName" class="col-sm-4 col-form-label">Sales Order Invoice:</label>
                                <div class="col-sm-8">
                                    <label class="col-form-label font-weight-bold">{{ $delivery->numSO }}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="customerName" class="col-sm-4 col-form-label">Status:</label>
                                <div class="col-sm-8">
                                    <label class="col-form-label font-weight-bold">
                                        @if ($delivery->status == 0)
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
                                    <label class="col-form-label font-weight-bold">{{ $delivery->dateDelivery }}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="customerName" class="col-sm-4 col-form-label">Delivered Date: </label>
                                <div class="col-sm-8">
                                    <label class="col-form-label font-weight-bold">{{ $delivery->dateReceived }}</label>
                                </div>
                            </div>
                            @if (isset($delivery->notes))
                                <div class="form-group row">
                                    <label for="customerName" class="col-sm-4 col-form-label">Notes: </label>
                                    <div class="col-sm-8">
                                        <label class="col-form-label font-weight-bold">{{ $delivery->notes }}</label>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                    @if ($delivery->status == 0)
                        <div class="modal-footer">
                            <form action="/delivery/sent/{{ $delivery->deliveryNum }}" method="POST">
                                @csrf
                                @method('patch')
                                <button type="submit" class="btn btn-secondary updatePost">Proceed Status</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

@endsection
