@extends('layouts.app')

@section('content')

    <div class="container">
        @include('message')
        <h1 class="text-center pt-5 pb-5">Warranty Detail</h1>
        <div class="row justify-content-center">
            <div class="col-6 pb-5">
                <div class="card" style="width: 100%;">
                    <div class="card-body pt-4">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Invoice Number:</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{ $warranty->numSO }}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Employee in Contact:</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{ $employee->name }}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Model Type:</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{ $warranty->modelType }}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Quantity:</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{ $warranty->quantity }}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Description:</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{ $warranty->description }}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Status:</label>
                            <div class="col-sm-8">
                                @if ($warranty->status == 0)
                                    <label class="col-form-label font-weight-bold">Not Yet Reedemed</label>
                                @else
                                    <label class="col-form-label font-weight-bold">Reedemed</label>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if ($warranty->status == 0)
                        <div class="modal-footer">
                            <form action="/warranty/status/{{ $warranty->numSO }}/{{ $warranty->modelType }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <a href="/warranty/update/{{ $warranty->numSO }}/{{ $warranty->modelType }}"
                                    class="btn btn-primary">Update Data</a>
                                <button type="submit" class="btn btn-success">Close the Case</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
