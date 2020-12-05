{{-- 
    Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
    Unauthorized copying of this file, via any medium is strictly prohibited
    Proprietary and confidential
    Code's Author by Albertus Kevin, Mikhael Adriel, December 2020 
--}}

@extends('layouts.authdummy')
@section('content')
{{-- hellow  --}}
<div class="container">
  <div class="row justify-content-center">
    <h1 class="text-center mt-5 mb-5 font-weight-bold">Pesona.</h1>
  </div>
  @include('message')
  <div class="row justify-content-center">
    <div class="card w-75">
      <div class="card-body pt-4">
        <form action="/gate" method="POST">
          @csrf
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
          </div>
          <div class="row justify-content-end text-right pr-3">
            <a href=""> Forgot your password?</a>
          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Remember me</label>
          </div>
          <div class="row w-100 ml-auto mr-auto">
            <button type="submit" class="btn btn-primary w-100 loginbtn">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="row justify-content-center pt-4">
    <p>Don't have an Account? <a href=""> Sign up Now</a></p>
  </div>
</div>
@endsection