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
    <h1 class="text-center mt-5 mb-5 font-weight-bold">Customer List</h1>
  </div>
  <div class="row justify-content-between">
    <div class="col-12 col-md-12 text-right">
      <div class="row text-right justify-content-end">
        <a href="/customer/create" type="button" name="" id="" class="defaultbtn btn btn-primary mr-2">New</a>
      </div>
    </div>
  </div>
  <div class="row pt-3">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Customer Id</th>
          <th scope="col">Name</th>
          <th scope="col">E-mail</th>
          <th scope="col">Phone Number</th>
          <th scope="col">Address</th>
          <th scope="col" class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        @foreach( $customers as $customer )
        <tr>
          <td>{{ $customer->id}}</td>
          <td>{{ $customer->name }}</td>
          <td>{{ $customer->email }}</td>
          <td>{{ $customer->phone }}</td>
          <td>{{ $customer->address }}</td>
          {{-- <td>{{ $customer->memberID }}</td> --}}
          <td class="text-center">
            <a href="/customer/update/{{$customer->id}}" class="btn btn-xs btn-primary">Edit</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection