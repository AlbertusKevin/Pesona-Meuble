{{-- 
    Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
    Unauthorized copying of this file, via any medium is strictly prohibited
    Proprietary and confidential
    Code's Author by Albertus Kevin, Chris Christian, Mikhael Adriel, December 2020 
--}}

@extends('layouts.app')

@section('content')

<div class="container">
    @include('message')
    <h1 class="text-center pt-5 pb-5">List of Sales Order</h1>
    <div class="row">
        @if(count($salesorders) == 0)
        <div class="col-12 col-md-4 pb-5">
            <div class="card" style="width: 100%;">
                <div class="card-body pl-5 pt-4">
                    <div class="row card-text">
                        <h3 class="font-weight-bold">No Sales Order On Process</h3>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @foreach($salesorders as $salesorder)
        <div class="col-12 col-md-4 pb-5">
            <div class="card" style="width: 100%;">
                <div class="card-body pl-5 pt-4">
                    <div class="row card-text">
                        <h3 class="font-weight-bold">Num: {{$salesorder->numSO}}</h3>
                    </div>
                    <div class="row card-text">
                        <p>{{$salesorder->date}} to {{$salesorder->validTo}}</p>
                    </div>
                    <div class="row pb-3">
                        <p>
                            <table>
                                <tr>
                                    <td>Customer </td>
                                    <td>: {{$salesorder->customer}}</td>
                                </tr>
                                <tr>
                                    <td>Employee in Charge </td>
                                    <td>: {{$salesorder->responsibleEmployee}}</td>
                                </tr>
                                <tr>
                                    <td>Transaction Status </td>
                                    <td>: {{$salesorder->transactionStatus}}</td>
                                </tr>
                                <tr>
                                    <td>Total Item </td>
                                    <td>: {{$salesorder->totalItem}}</td>
                                </tr>
                                <tr>
                                    <td>Total Meuble Discount </td>
                                    <td>: {{$salesorder->totalMeubleDiscount}}</td>
                                </tr>
                                <tr>
                                    <td>Total Discount </td>
                                    <td>: {{$salesorder->totalDiscount}}</td>
                                </tr>
                                <tr>
                                    <td>Total Price</td>
                                    <td>: {{$salesorder->totalPrice}}</td>
                                </tr>
                            </table>
                        </p>
                    </div>
                    <div class="row card-text">
                        <a href="/salesorder/{{$salesorder->numSO}}" class="more">More...</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row w-100 justify-content-center">
        {{-- {{$salesorders->links()}} --}}
    </div>
</div>

@endsection