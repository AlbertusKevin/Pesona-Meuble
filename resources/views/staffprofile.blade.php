@extends('layouts.navbaronly')
@section('content')
<div class="row  maxheight">
    <img  src="{{ asset('images/promo1.svg') }}" class="d-block w-100" alt="...">
</div>

  <div class="container">
    <div class="row justify-content-center">
      <h1 class="text-center mt-5 mb-5 font-weight-bold">My Profile</h1>
    </div>
    <div class="row justify-content-center">
        <div class="">
            <img class="profilepicture" src="{{ asset('images/lolito.svg') }}" alt="...">
        </div>
    </div>
    <div class="row justify-content-center">
      <div class="card mt-5 w-75 p-5 mb-5">
        <div class="card-body">
            <div class="form-group row pb-3 justify-content-center">
                <label for="staticEmail" class="col-sm-4 col-form-label">Full Name</label>
                <div class="col-sm-6">
                  <input type="text" readonly class="form-control-plaintext" id="" value="B4mbang Hermawan">
                </div>
            </div>
            <div class="form-group row pb-3 justify-content-center">
                <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-6">
                  <input type="text" readonly class="form-control-plaintext" id="" value="B4ambang@gmail.com">
                </div>
            </div>
            <div class="form-group row pb-3 justify-content-center">
                <label for="staticEmail" class="col-sm-4 col-form-label">Phone Number</label>
                <div class="col-sm-6">
                  <input type="text" readonly class="form-control-plaintext" id="" value="0812345678912">
                </div>
            </div>
            <div class="form-group row pb-3 justify-content-center">
                <label for="staticEmail" class="col-sm-4 col-form-label">Address</label>
                <div class="col-sm-6">
                  <input type="text" readonly class="form-control-plaintext" id="" value="-">
                </div>
            </div>
            <div class="row pl-5 ml-3">
                <a class="pt-2"href="">Edit Profile</a>
            </div>

            <div class="form-group row pb-3 mt-5 justify-content-center">
                <label for="staticEmail" class="col-sm-4 col-form-label">Password</label>
                <div class="col-sm-6">
                  <input type="text" readonly class="form-control-plaintext" id="staticPassword" value="********">
                </div>
            </div>
            <div class="row pl-5 ml-3">
                <a class="pt-2"href="">Edit Password</a>
            </div>
            
            </div>
            </div>
        </div>
  </div> 
@endsection
