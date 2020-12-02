@extends('layouts.app')
@section('content')
    <div class="container">
      @include('message')
      <div class="row justify-content-center">
        <h1 class="text-center mt-5 mb-5 font-weight-bold">Employee List</h1>
      </div>
      <div class="row justify-content-between">
          <div class="col-12 col-md-4">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              </form>
          </div>
          <div class="col-12 col-md-5 text-right">
            <div class="row text-right justify-content-end">
                <a class="defaultbtn btn btn-primary mr-2" href='/employee/create'>New</a>
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
                <th scope="col">Employee Id</th>
                <th scope="col">Nama</th>
                <th scope="col">Role</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">Phone</th>
              </tr>
            </thead>
            <tbody>
              @foreach($employees as $employee)
                <tr class="separator" ><th scope="row"></th></tr>
                <tr class="trcard">
                  <th scope="row">{{$employee->id}}</th>
                  <td><a href='/employee/detail/{{$employee->id}}'>{{$employee->name}}</a></td>
                  <td>{{$employee->role}}</td>
                  <td class="text-center">{{$employee->email}}</td>
                  <td class="text-center">{{$employee->phone}}</td>
                </tr>
              @endforeach
          </table>
      </div>
    </div>
@endsection