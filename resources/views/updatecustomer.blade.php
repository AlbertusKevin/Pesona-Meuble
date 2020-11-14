@extends('layouts.navbaronly')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <h1 class="text-center mt-5 mb-5 font-weight-bold">Update User</h1>
    </div>
    <div class="row justify-content-center">
        <div class="card p-5" style="width: 75%;">
            <div class="card-body pt-4">
                <form>
                    <div class="form-group row">
                        <label for="customerName" class="col-sm-3 col-form-label">First Name:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customerName" class="col-sm-3 col-form-label">Last Name:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customerName" class="col-sm-3 col-form-label">Email:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customerName" class="col-sm-3 col-form-label">Phone Number:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customerName" class="col-sm-3 col-form-label">Address:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </form>
                <div class="row justify-content-center">
                    <a name="" id="" class="btn mt-4 defaultbtn btn-primary mr-3" href="#" role="button">Save</a>
                    <a name="" id="" class="btn  mt-4 btn-light" href="#" role="button">Cancel</a>
                </div>
            </div>
        </div>
    </div>
  </div> 
@endsection
