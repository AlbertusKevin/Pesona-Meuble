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
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="container pt-5">
        <div class="row">
            <div class="col-12 col-md-6">
                <img src="{{ asset('images/promo3.svg') }}" class="d-block w-100 h-100" alt="...">
            </div>
            <div class="col-12 col-md-6git">
                <h2>{{ $meuble->name }}</h2>
                <p class="font-weight-bold">{{ $meuble->description }}</p>
                <p class="font-weight-bold">{{ $meuble->modelType }}</p>
                <p>
                <table>
                    <tr>
                        <td>Category </td>
                        <td>: {{ $category->description }}</td>
                    </tr>
                    <tr>
                        <td>Price </td>
                        <td>: {{ $meuble->price }}</td>
                    </tr>
                    <tr>
                        <td>Warranty Period (Month) </td>
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
                </p>
            </div>
        </div>
    </div>

    <div>

    </div>

@endsection
