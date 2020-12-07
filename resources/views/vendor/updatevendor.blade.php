@extends('layouts.navbaronly')

@section('content')

  <div class="container">
    @include('message')
    <div class="row justify-content-center">
      <h1 class="text-center mt-5 mb-5 font-weight-bold">Update Vendor</h1>
    </div>
    <div class="row justify-content-center">
        <div class="card p-5" style="width: 75%;">
            <div class="card-body pt-4">
                <form action="/vendor/update/{{'$vendors->companyCode'}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label for="customerName" class="col-sm-3 col-form-label">Name:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" value="{{'$vendors->name'}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customerName" class="col-sm-3 col-form-label">Email:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="email" name="email" value="{{'$vendors->email'}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customerName" class="col-sm-3 col-form-label">Phone Number:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="telephone" name="telephone" value="{{'$vendors->telephone'}}">
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label for="customerName" class="col-sm-3 col-form-label">Address:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="address" name="address" value={{$customers->address}}>
                        </div>
                    </div> --}}
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-secondary buttonPurple">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div> 

@endsection
