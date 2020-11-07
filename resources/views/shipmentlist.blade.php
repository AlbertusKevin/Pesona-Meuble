@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row justify-content-center">
        <h1 class="text-center mt-5 mb-5 font-weight-bold">Shipment List</h1>
      </div>
      <div class="row justify-content-between">
          <div class="col-12 col-md-4">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              </form>
          </div>
          <div class="col-12 col-md-5 text-right">
            <div class="dropdown">
                <button class="btn defaultbtn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
      <div class="row pt-3">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Shipment Invoice</th>
                <th scope="col">Sales Order Number</th>
                <th scope="col" class="text-center">Shipment Date</th>
                <th scope="col" class="text-center">Delivered Date</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr class="trcard">
                <th scope="row">SH-001</th>
                <td>SO-001</td>
                <td class="text-center">22/10/2020</td>
                <td class="text-center">26/10/2020</td>
                <td>Delivered to Customer</td>
              </tr>
              <tr class="separator" ><th scope="row"></th></tr>
              <tr class="trcard">
                <th scope="row">SH-002</th>
                <td>SO-002</td>
                <td class="text-center">22/10/2020</td>
                <td class="text-center">27/10/2020</td>
                <td >Delivered to Customer</td>
              </tr>
              <tr class="separator" ><th scope="row"></th></tr>
              <tr class="trcard">
                <th scope="row">SH-003</th>
                <td>SO-003</td>
                <td class="text-center">24/10/2020</td>
                <td class="text-center">~</td>
                <td> Being Delivered</td>
              </tr>
              <tr class="separator" ><th scope="row"></th></tr>
            </tbody>
          </table>
      </div>
    </div>
@endsection