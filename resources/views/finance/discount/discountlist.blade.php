{{--
    Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
    Unauthorized copying of this file, via any medium is strictly prohibited
    Proprietary and confidential
    Code's Author by Chris Christian, Mikhael Adriel, December 2020 
--}}

@extends('layouts.app')
@section('content')
<div class="container">
  @include('message')
  <div class="row justify-content-center">
    <h1 class="text-center mt-5 mb-5 font-weight-bold">Discount List</h1>
  </div>
  <div class="row justify-content-between">
    <div class="col-12 col-md-12 text-right">
      <div class="row text-right justify-content-end">
        <a href='/discount/create' type="button" name="" id="" class="defaultbtn btn btn-primary mr-2"> New</a>
      </div>
    </div>
  </div>
  <div class="row pt-3">
    <table class="table">
      <thead>
        <tr>
          <th scope="col" class="text-center">Code Discount</th>
          <th scope="col" class="text-center">Discount Percentage</th>
          <th scope="col">Status</th>
          <th scope="col" class="text-center">From</th>
          <th scope="col" class="text-center">To</th>
          <th scope="col" class="text-center"></th>
        </tr>
      </thead>
      </tbody>
      @foreach($discounts as $discount)
      <tr class="separator">
        <th scope="row"></th>
      </tr>
      <tr class="trcard">
        <th scope="row" class="text-center"><a href='/discount/detail/{{$discount->code}}'>{{$discount->code}}</a></th>
        <td class="text-center">{{$discount->percentDisc * 100 . '%'}}</td>
        @if($discount->statusActive === 1)
        <td>Active</td>
        @else
        <td>Expired</td>
        @endif
        <td class="text-center">{{$discount->from}}</td>
        <td class="text-center">{{$discount->to}}</td>
        <td class="text-center">
          <form action='/discount/delete/{{$discount->code}}' method='POST'>
            @method('DELETE')
            @csrf
            <button type='submit' class="btn btn-xs btn-danger">Delete</a>
          </form>
        </td>
      </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection