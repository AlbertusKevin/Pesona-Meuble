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
    <h1 class="text-center mt-5 mb-5 font-weight-bold">Employee List</h1>
  </div>
  <div class="row justify-content-between">
    <div class="col-12 col-md-12 text-right">
      <div class="row text-right justify-content-end">
        <a class="defaultbtn btn btn-primary mr-2" href='/employee/create'>New</a>
      </div>
    </div>
  </div>
  <div class="row pt-3">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Employee Id</th>
          <th scope="col">Nama</th>
          <th scope="col">Role</th>
          <th scope="col" class="text-center">Email</th>
          <th scope="col" class="text-center">Phone</th>
        </tr>
      </thead>
      <tbody>
        @foreach($employees as $employee)
        <tr class="separator">
          <th scope="row"></th>
        </tr>
        <tr class="trcard">
          <th scope="row">{{$employee->id}}</th>
          <td><a href='/employee/{{$employee->id}}'>{{$employee->name}}</a></td>
          <td>{{$employee->role}}</td>
          <td class="text-center">{{$employee->email}}</td>
          <td class="text-center">{{$employee->phone}}</td>
        </tr>
        @endforeach
    </table>
  </div>
</div>
@endsection