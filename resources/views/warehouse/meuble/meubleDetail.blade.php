{{--
Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
Unauthorized copying of this file, via any medium is strictly prohibited
Proprietary and confidential
Code's Author by Chris Christian, Mikhael Adriel, December 2020
--}}
@extends('layouts.appcust')

@section('content')
    {{-- carousel --}}
    <div class="container-fluid">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div style="position: relative !important" class="carousel-item active">
                    <div class="carousel_image">
                        <img src="{{ asset('images/promo1.svg') }}" class="d-block w-100" alt="...">
                        <div class="overlay">
                            <h2 style="color:#FFFFFF" class=" font-weight-bold pb-3 pt-3 pr-3 pl-3">High Quality Furniture
                                Just For You</h2>
                            <p style="color:#FFFFFF" class="  pb-3 pr-3 pl-3">Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit. Donec massa purus, tristique quis lacus eget, sagittis cursus lorem.
                                Quisque bibendum suscipit tortor quis ornare.</p>
                            <div class="pb-3 pr-3 pl-3">
                                <a class=" btn btn-primary w-100" href="www.google.com">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel_image">
                        <img src="{{ asset('images/promo2.svg') }}" class="d-block w-100" alt="...">
                        <div class="overlay">
                            <h2 style="color:#FFFFFF" class=" font-weight-bold pb-3 pt-3 pr-3 pl-3">High Quality Furniture
                                Just For You</h2>
                            <p style="color:#FFFFFF" class="  pb-3 pr-3 pl-3">Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit. Donec massa purus, tristique quis lacus eget, sagittis cursus lorem.
                                Quisque bibendum suscipit tortor quis ornare.</p>
                            <div class="pb-3 pr-3 pl-3">
                                <a class=" btn btn-primary w-100" href="www.google.com">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel_image">
                        <img src="{{ asset('images/promo3.svg') }}" class="d-block w-100" alt="...">
                        <div class="overlay">
                            <h2 style="color:#FFFFFF" class=" font-weight-bold pb-3 pt-3 pr-3 pl-3">High Quality Furniture
                                Just For You</h2>
                            <p style="color:#FFFFFF" class="  pb-3 pr-3 pl-3">Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit. Donec massa purus, tristique quis lacus eget, sagittis cursus lorem.
                                Quisque bibendum suscipit tortor quis ornare.</p>
                            <div class="pb-3 pr-3 pl-3">
                                <a class=" btn btn-primary w-100" href="www.google.com">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-1">
                <img src="{{ asset($meuble->image) }}" class="d-block w-100 h-100" alt="...">
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
            </div>
        </div>
    </div>

    <div>

    </div>

@endsection
