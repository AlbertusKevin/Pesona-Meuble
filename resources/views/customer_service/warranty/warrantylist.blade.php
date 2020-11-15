@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row justify-content-center">
        <h1 class="text-center mt-5 mb-5 font-weight-bold">Warranty List</h1>
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
                <th scope="col">Shipment Invoice</th>
                <th scope="col" class="text-center">Valid From</th>
                <th scope="col" class="text-center">Valid To</th>
                <th scope="col" class="text-center">Furniture Name</th>
                <th scope="col" class="text-center">Qty</th>
                <th scope="col" class="text-center">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr class="trcard">
                <th scope="row">SH-001</th>
                <td class="text-center">22/10/2020</td>
                <td class="text-center">22/12/2020</td>
                <td class="text-center">Coffee table, black</td>
                <td class="text-center">1</td>
                <td class="text-center">Not Yet Reedemed</td>
              </tr>
              <tr class="separator" ><th scope="row"></th></tr>
              <tr class="trcard">
                <th scope="row">SH-002</th>
                <td class="text-center">22/10/2020</td>
                <td class="text-center">22/12/2020</td>
                <td class="text-center">Swifel-Chair, blue</td>
                <td class="text-center">2</td>
                <td class="text-center">Reedemed</td>
              </tr>
              <tr class="separator" ><th scope="row"></th></tr>
              <tr class="trcard">
                <th scope="row">SH-003</th>
                <td class="text-center">22/10/2020</td>
                <td class="text-center">22/12/2020</td>
                <td class="text-center">Dining Chair, Yellow</td>
                <td class="text-center">4</td>
                <td class="text-center">Not Yet Reedemed</td>
              </tr>
              <tr class="separator" ><th scope="row"></th></tr>
            </tbody>
          </table>
      </div>
    </div>
@endsection