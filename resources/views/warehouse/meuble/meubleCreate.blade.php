@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 mt-3">
                @include('message')
                <form action="/meuble" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body mb-2">
                            <div class="col-md-12 text-center mb-3">
                                <h1>New Meuble</h1>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="modelType" class="col-sm-3 col-form-label">Model Type:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="modelType" id="modelType">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="meubleName" class="col-sm-3 col-form-label">Meuble Name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="meubleName" name="meubleName">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="vendor" class="col-sm-3 col-form-label">Vendor:</label>
                                    <div class="col-sm-8">
                                        <select id="vendor" name="vendor" class="form-control header-field-form">
                                            @foreach ($vendors as $vendor)
                                                <option value="{{ $vendor->companyCode }}">
                                                    {{ $vendor->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="picture" class="col-sm-3 col-form-label">Picture:</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" name="picture" id="picture">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="category" class="col-sm-3 col-form-label">Category:</label>
                                    <div class="col-sm-8">
                                        <select id="category" name="category" class="form-control">
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}">
                                                    {{ $cat->description }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="size" class="col-sm-3 col-form-label">Size:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="size" id="size">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="color" class="col-sm-3 col-form-label">Color:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="color" name="color">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-3 col-form-label">Description:</label>
                                    <div class="col-sm-8">
                                        <textarea rows="4" cols="50" class="form-control" name="description"
                                            id="description">input Description</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="warranty" class="col-sm-3 col-form-label">Warranty (Month):</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="warranty" id="warranty">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="price" class="col-sm-3 col-form-label">Price:</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="price" id="price">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="addItem">New Meuble</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
