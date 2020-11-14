@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="text-center pt-5 pb-5">Employee Detail</h1>
    <div class="row justify-content-center">
        <div class="col-6 pb-5">
            <div class="card" style="width: 100%;">
                <div class="card-body pt-4">
                    <form>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Employee ID: </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">EM-001</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Employee Name:</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">Joko Nugraha</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Roles:</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">Sales</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">E-mail:</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">Joko24@gmail.com</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Telephone Number: </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">Jalan Padarisih 19, Cibinong Jakarta Utara</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Gaji Awal: </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">Rp 500.000,00</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <button type="button" class="btn btn-secondary updatePost">Add</button>
    </div>
</div>

@endsection