@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        @if (session('success_po_0'))
        <div class="alert alert-success">
            {{ session('success_po_0') }}
        </div>
        @endif
    </div>
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