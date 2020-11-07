@extends('layouts.navbaronly')

@section('content')

<div class="container">
    <h1 class="text-center pt-5 pb-5">Discount Detail</h1>
    <div class="row justify-content-center">
        <div class="col-6 pb-5">
            <div class="card" style="width: 100%;">
                <div class="card-body pt-4">
                    <form>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Kode: </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">DC-001</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Valid From:</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">26/10/2020</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Valid To:</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">12/12/2020</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Person in charge:</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">Joko Nugraha</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Discount: </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">20%</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Status: </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">Available</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Notes: </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">Discount Halloween Day</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <button type="button" class="btn btn-secondary buttonPurple">Edit</button>
    </div>
    <div class="row justify-content-center pt-3 pb-5">
        <a href="#" class="more">Back</a>
    </div>
</div>
</div>

@endsection