{{-- 
    Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
    Unauthorized copying of this file, via any medium is strictly prohibited
    Proprietary and confidential
    Code's Author by Mikhael Adriel, December 2020 
--}}

@extends('layouts.app')
@section('content')
    <div class="container">
      @include('message')
      <div class="row justify-content-center">
        <h1 class="text-center mt-5 mb-5 font-weight-bold">Customer List</h1>
      </div>
      <div class="row justify-content-between">
          <div class="col-12 col-md-4">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              </form>
          </div>
          <div class="col-12 col-md-5 text-right">
            <div class="row text-right justify-content-end">
                <a href="/customer/create" type="button" name="" id="" class="defaultbtn btn btn-primary mr-2" > New</a>
                <div class="dropdown">
                    <button class="btn btn-secondary defaultbtn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Sort
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#">Sort Opt1</a>
                      <a class="dropdown-item" href="#">Sort Opt2</a>
                      <a class="dropdown-item" href="#">Sort Opt3</a>
                    </div>
                </div>
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
                <th scope="col">Action</th>
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
                      <td>{{ $customer->memberID }}</td>
                      <td class="text-center">
                          <a href="/customer/update/{{'$customers->id'}}" class="btn btn-xs btn-primary">Edit</a> 
                      </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
      </div>
    </div>
@endsection