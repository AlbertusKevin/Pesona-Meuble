@extends('layouts.app')

@section('content')

    <div class="container">
        @include('message')
        <h1 class="text-center pt-5 pb-5 heading" id="{{ $warranty->numSO }}">Edit Warranty</h1>
        <div class="row justify-content-center">
            <div class="col-6 pb-5">
                <div class="card" style="width: 100%;" id="{{ $warranty->modelType }}">
                    <div class=" card-body pt-4 info-item">
                        <form action="/warranty/{{ $warranty->numSO }}/{{ $warranty->modelType }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <label for="customerName" class="col-sm-4 col-form-label">Invoice Number: </label>
                                <div class="col-sm-8">
                                    <label class="col-form-label font-weight-bold">{{ $warranty->numSO }}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="customerName" class="col-sm-4 col-form-label">Employee in Contact:</label>
                                <div class="col-sm-8">
                                    <label class="col-form-label font-weight-bold">{{ $employee->name }}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="customerName" class="col-sm-4 col-form-label">Model Type:</label>
                                <div class="col-sm-8">
                                    <label class="col-form-label font-weight-bold">{{ $warranty->modelType }}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="quantity" class="col-md-4 col-form-label">Quantity
                                    :</label>
                                <div class="col-md-4">
                                    <input type="number" class="form-control quantity-warranty" name="quantity"
                                        placeholder="Quantity" value={{ $warranty->quantity }}>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="information" class="col-form-label">Information:</label>
                                <textarea class=" form-control" id="information" name="information"
                                    rows="3">{{ $warranty->description }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">

        </div>
    </div>

@endsection
