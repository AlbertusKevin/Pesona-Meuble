@extends('layouts.appcust')
@include('message')
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
                                <a style="" class=" btn btn-primary w-100" href="www.google.com">Shop Now</a>
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
                                <a style="" class=" btn btn-primary w-100" href="www.google.com">Shop Now</a>
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
                                <a style="" class=" btn btn-primary w-100" href="www.google.com">Shop Now</a>
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
    {{-- card layout --}}
    <div class="container">
        <div class="col-12 pt-4">
            <h1 class="text-center">Our Product</h1>
        </div>
        <div class="row justify-content-center">
            @if (count($meubles) > 0)
                @foreach ($meubles as $meuble)
                    @if ($meuble->status != 0)
                        <div class="col-md-4 pt-3">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="{{ asset($meuble->image) }}" alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="font-weight-bold">{{ $meuble->name }}</h4>
                                    <p class="card-text text-muted">Available: {{ $meuble->stock }}</p>
                                    <h5 class="font-weight-bold">{{ $meuble->price }}</h5>
                                    <a style="color:#9B51E0;text-decoration:none"
                                        href="/meuble/{{ $meuble->modelType }}">Detail</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="row w-100 justify-content-center">
                    <h3>No Item Found</h3>
                </div>
            @endif
        </div>
    </div>

@endsection
