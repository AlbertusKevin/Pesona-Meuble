{{--
Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
Unauthorized copying of this file, via any medium is strictly prohibited
Proprietary and confidential
Code's Author by Chris Christian, Mikhael Adriel, December 2020
--}}
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-1">
                <img src="{{ asset('images/forestrine.svg') }}" class="d-block w-100 h-100" alt="...">
            </div>
            <div class="col-md-4">
                <h1>{{ $meuble->name }}</h1>
                <h6 class="card-subtitle mb-2 text-muted">Model Type: {{ $meuble->modelType }}</h6>
                <hr>
                <p class="font-weight-bold">{{ $meuble->description }}</p>
                <table>
                    <tr>
                        <td class="mr-5">Category</td>
                        <td>: {{ $category->description }}</td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>: {{ $meuble->price }}</td>
                    </tr>
                    <tr>
                        <td>Warranty (Month)</td>
                        <td>: {{ $meuble->warantyPeriodeMonth }}</td>
                    </tr>
                    <tr>
                        <td>Size </td>
                        <td>: {{ $meuble->size }}</td>
                    </tr>
                    <tr>
                        <td>Stock </td>
                        <td>: {{ $meuble->stock }}</td>
                    </tr>
                    <tr>
                        <td>Color </td>
                        <td>: {{ $meuble->stock }}</td>
                    </tr>
                </table>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <form action="/meuble/{{ $meuble->modelType }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="/meuble/update/{{ $meuble->modelType }}" class="btn btn-warning mr-2">Update</a>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
