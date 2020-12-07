@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <h1 class="text-center mt-5 mb-5 font-weight-bold">Shipment List</h1>
  </div>
  <div class="row pt-3">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Delivery Num</th>
          <th scope="col" class="text-center">Shipment Date</th>
          <th scope="col" class="text-center">Delivered Date</th>
          <th scope="col">Status</th>
          <th>Detail</th>
        </tr>
      </thead>
      <tbody>
        @if(count($deliveries) == 0)
        <tr class="trcard">
          <th class="text-center" colspan="5" scope="row">No deliveries have occurred yet</th>
        </tr>
        <tr class="separator">
          <th colspan="5" scope="row"></th>
        </tr>
        @endif
        @foreach($deliveries as $delivery)
        <tr class="trcard">
          <th scope="row" class="text-center">{{$delivery->deliveryNum}}</th>
          <td class="text-center">{{$delivery->dateDelivery}}</td>
          <td class="text-center">{{$delivery->dateReceived}}</td>
          @if($delivery->status == 0)
          <td>Being Delivered</td>
          @else
          <td>Delivered to Customer</td>
          @endif
          <td>
            <form action="/delivery/detail/{{$delivery->deliveryNum}}">
              <button type="submit" class="btn-sml btn-primary">Detail</button>
            </form>
          </td>
        </tr>
        <tr class="separator">
          <th scope="row"></th>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection