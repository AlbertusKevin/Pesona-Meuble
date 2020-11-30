@extends('layouts.app')

@section('content')

<div class="container">
    @include('message')
    <h1 class="text-center pt-5 pb-5">History List of Purchase Order</h1>
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
                            Person in Charge: {{$po->responsibleEmployee}}<br>
                            Total Item: {{$po->totalItem}}<br>
                            Amount Total: {{$po->totalPrice}}<br>
                            Amount Diskon: {{$po->totalDiscount}}<br>
                            Freight In: {{$po->freightIn}}<br>
                            Total Purchase: {{$po->totalPayment}}<br>
                            Transaction Status: {{$po->transactionStatus}}
                        </p>
                    </div>
                    <div class="row card-text">
                        <a href="/procurement/history/detail/{{$po->numPO}}" class="more">More Detail...</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>

@endsection