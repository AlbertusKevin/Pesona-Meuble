@extends('layouts.app')
@section('content')
    <div class="container">
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
                <button type="button" name="" id="" class="defaultbtn btn btn-primary mr-2" > New</button>
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
                <th scope="col">Nama</th>
                <th scope="col">Type</th>
                <th scope="col" class="text-center">Email</th>
              </tr>
            </thead>
            <tbody>
              <tr class="trcard">
                <th scope="row">CM-001</th>
                <td >Bambang Hermawan</td>
                <td >Member</td>
                <td class="text-center">B4mbang@gmail.com</td>
              </tr>
              <tr class="separator" ><th scope="row"></th></tr>
              <tr class="trcard">
                <th scope="row">CM-002</th>
                <td >Devina Belinda</td>
                <td >Non-member</td>
                <td class="text-center">Devi123@rocketmail.com</td>
              </tr>
              <tr class="separator" ><th scope="row"></th></tr>
              <tr class="trcard">
                <th scope="row">CM-003</th>
                <td >Vardina Nava</td>
                <td >Non-member</td>
                <td class="text-center">Dina777@gmail.com</td>
              </tr>
              <tr class="separator" ><th scope="row"></th></tr>
            </tbody>
          </table>
      </div>
    </div>
@endsection