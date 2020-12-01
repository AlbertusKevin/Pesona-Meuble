@extends('layouts.app')

@section('content')

<div class="container">
    @include('message')
    <h1 class="text-center pt-5 pb-5">List of Sales Order</h1>
    @if(count($salesorders) > 0)
        <div class="row">
            @foreach($salesorders as $salesorder)
                <div class="col-12 col-md-4 pb-5">
                    <div class="card" style="width: 100%;">
                        <div class="card-body pl-5 pt-4">
                            <div class="row card-text">
                                <h3 class="font-weight-bold">{{$salesorder->numSO}}</h3>
                            </div>
                            <div class="row card-text">
                                <p>{{$salesorder->date}}</p>
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
                                <a href="/salesorder/detail/{{$salesorder->numSO}}" class="more">More...</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row w-100 justify-content-center">
            {{-- {{$salesorders->links()}} --}}
        </div>
    @else 
        <div class="row w-100 justify-content-center">
            <h3>No Sales Order Found</h3>
        </div>
    @endif
    
</div>

@endsection