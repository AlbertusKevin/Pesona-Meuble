@extends('layouts.authdummy')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <h1 class="text-center mt-5 mb-5 font-weight-bold">Pesona.</h1>
    </div>
    <div class="row justify-content-center">
      <div class="card w-75">
        <div class="card-body pt-4">
          <form>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1">
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
