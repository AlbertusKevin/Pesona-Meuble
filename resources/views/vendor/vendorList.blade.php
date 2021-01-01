{{--
    Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
    Unauthorized copying of this file, via any medium is strictly prohibited
    Proprietary and confidential
    Code's Author by Chris Christian, December 2020 
--}}

@extends('layouts.app')
@section('content')
<div class="container">
  @include('message')
  <div class="row justify-content-center">
    <h1 class="text-center mt-5 mb-5 font-weight-bold">Vendor List</h1>
  </div>
  <div class="row justify-content-between">
    <div class="col-12 col-md-12 text-right">
      <div class="row text-right justify-content-end">
        <a class="defaultbtn btn btn-primary mr-2" href='/vendor/create'>New</a>
      </div>
    </div>
  </div>
  <div class="row pt-3">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Company Code</th>
          <th scope="col">Name</th>
          <th scope="col" class="text-center">Email</th>
          <th scope="col" class="text-center">Telephone</th>
          <th scope="col" class="text-center">Address</th>
          <th scope="col" class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($vendors as $vendor)
        <tr class="separator">
          <th scope="row"></th>
        </tr>
        <tr class="trcard">
          <th scope="row">{{$vendor->companyCode}}</th>
          <td><a href='/vendor/{{$vendor->companyCode}}'>{{$vendor->name}}</a></td>
          <td class="text-center">{{$vendor->email}}</td>
          <td class="text-center">{{$vendor->telephone}}</td>
          <td class="text-center">{{$vendor->address}}</td>
          <td class="text-center">
            <a href="/vendor/update/{{$vendor->companyCode}}" class="btn btn-xs btn-primary">Edit</a>
          </td>
        </tr>
        @endforeach
    </table>
  </div>
</div>
@endsection