@extends('layouts.app')
@section('content')
    <div class="container">
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
                <th scope="col">Employee Id</th>
                <th scope="col">Nama</th>
                <th scope="col">Role</th>
                <th scope="col" class="text-center">Email</th>
              </tr>
            </thead>
            <tbody>
              <tr class="trcard">
                <th scope="row">EM-001</th>
                <td >Joko Nugraha</td>
                <td >Sales</td>
                <td class="text-center">Joko24@gmail.com</td>
              </tr>
              <tr class="separator" ><th scope="row"></th></tr>
              <tr class="trcard">
                <th scope="row">EM-002</th>
                <td >Devi Ningsih</td>
                <td >Sales</td>
                <td class="text-center">DeviSyantik@rocketmail.com</td>
              </tr>
              <tr class="separator" ><th scope="row"></th></tr>
              <tr class="trcard">
                <th scope="row">EM-003</th>
                <td >Lukas Setiawan</td>
                <td >Storage</td>
                <td class="text-center">Lukas89@gmail.com</td>
              </tr>
              <tr class="separator" ><th scope="row"></th></tr>
            </tbody>
          </table>
      </div>
    </div>
@endsection