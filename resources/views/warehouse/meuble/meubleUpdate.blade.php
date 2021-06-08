@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 mt-3">
                @include('message')
                <form action="/meuble/{{ $meuble->modelType }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body mb-2">
                            <div class="col-md-12 text-center mb-3">
                                <h1>Update Meuble</h1>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="meubleName" class="col-sm-3 col-form-label">Meuble Name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="meubleName" name="meubleName"
                                            value={{ $meuble->name }}>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="vendor" class="col-sm-3 col-form-label">Vendor:</label>
                                    <div class="col-sm-8">
                                        <select id="vendor" name="vendor" class="form-control header-field-form">
                                            <option value="{{ $vendor->companyCode }}">
                                                {{ $vendor->name }}
                                            </option>
                                            @foreach ($vendors as $vendor)
                                                @if ($vendor->name != $vendor->name)
                                                    <option value="{{ $vendor->companyCode }}">
                                                        {{ $vendor->name }}
                                                    </option>
                                                @endif
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
                                            <option value="{{ $meuble->category }}">
                                                {{ $category->description }}
                                            </option>
                                            @foreach ($categories as $category)
                                                @if ($category->description != $category->description)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->description }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="size" class="col-sm-3 col-form-label">Size:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="size" id="size"
                                            value="{{ $meuble->size }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="color" class="col-sm-3 col-form-label">Color:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="color" name="color"
                                            value="{{ $meuble->color }}">
                                    </div>
                                </div>
                                <div class=" form-group row">
                                    <label for="description" class="col-sm-3 col-form-label">Description:</label>
                                    <div class="col-sm-8">
                                        <textarea rows="4" cols="50" class="form-control" name="description"
                                            id="description"
                                            placeholder="input meuble description">{{ $meuble->description }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="warranty" class="col-sm-3 col-form-label">Warranty (Month):</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="warranty" id="warranty"
                                            value={{ $meuble->warantyPeriodeMonth }}>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="price" class="col-sm-3 col-form-label">Price:</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="price" id="price"
                                            value={{ $meuble->price }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning" id="addItem">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
