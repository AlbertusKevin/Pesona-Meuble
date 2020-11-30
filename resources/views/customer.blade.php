@extends('layouts.app')

@section('content')
{{--  carousel  --}}
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
                <img  src="{{ asset('images/promo1.svg') }}" class="d-block w-100" alt="...">
                <div class="overlay">
                    <h2 style="color:#FFFFFF" class=" font-weight-bold pb-3 pt-3 pr-3 pl-3">High Quality Furniture Just For You</h2>
                    <p style="color:#FFFFFF" class="  pb-3 pr-3 pl-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec massa purus, tristique quis lacus eget, sagittis cursus lorem. Quisque bibendum suscipit tortor quis ornare.</p>
                    <div class="pb-3 pr-3 pl-3">
                        <a style="" class=" btn btn-primary w-100" href="www.google.com">Shop Now</a>
                    </div>
                </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="carousel_image">
                <img  src="{{ asset('images/promo2.svg') }}" class="d-block w-100" alt="...">
                <div class="overlay">
                    <h2 style="color:#FFFFFF" class=" font-weight-bold pb-3 pt-3 pr-3 pl-3">High Quality Furniture Just For You</h2>
                    <p style="color:#FFFFFF" class="  pb-3 pr-3 pl-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec massa purus, tristique quis lacus eget, sagittis cursus lorem. Quisque bibendum suscipit tortor quis ornare.</p>
                    <div class="pb-3 pr-3 pl-3">
                        <a style="" class=" btn btn-primary w-100" href="www.google.com">Shop Now</a>
                    </div>
                </div>
            </div>
          </div>
        <div class="carousel-item">
            <div class="carousel_image">
                <img  src="{{ asset('images/promo3.svg') }}" class="d-block w-100" alt="...">
                <div class="overlay">
                    <h2 style="color:#FFFFFF" class=" font-weight-bold pb-3 pt-3 pr-3 pl-3">High Quality Furniture Just For You</h2>
                    <p style="color:#FFFFFF" class="  pb-3 pr-3 pl-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec massa purus, tristique quis lacus eget, sagittis cursus lorem. Quisque bibendum suscipit tortor quis ornare.</p>
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

<div class="container pt-5">
    <div class="row">
        <div class="col-12 col-md-6">
            <img  src="{{ asset('images/detail.svg') }}" class="d-block w-100 h-100" alt="...">
        </div>
        <div class="col-12 col-md-6git">
            <h2>Craft the home with furniture</h2>
            <p class="font-weight-bold">Deskripsi</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                In ornare neque tellus, accumsan pretium purus congue vitae.
                Morbi eu varius turpis, ac aliquet massa. 
                Integer ac tortor consectetur, rhoncus felis sit amet, ullamcorper ex.
                Etiam a pretium purus. Aliquam eget tincidunt lectus, in vulputate odio.
                Nullam eget nisl auctor ante imperdiet accumsan non eget nisl.
                Aliquam pharetra non risus sed laoreet.
                Quisque accumsan leo ac odio accumsan, luctus pulvinar sapien commodo.
                Nunc dui nibh, aliquet id hendrerit id, scelerisque egestas odio.
                Fusce a erat orci. Sed vel diam metus.
            </p>
            <p class="font-weight-bold">Tipe Model</p>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                In ornare neque tellus, accumsan pretium purus congue vitae.
                Morbi eu varius turpis, ac aliquet massa. 
                Integer ac tortor consectetur, rhoncus felis sit amet, ullamcorper ex.
                Etiam a pretium purus. Aliquam eget tincidunt lectus, in vulputate odio.
                Nullam eget nisl auctor ante imperdiet accumsan non eget nisl.
                Aliquam pharetra non risus sed laoreet.
                Quisque accumsan leo ac odio accumsan, luctus pulvinar sapien commodo.
                Nunc dui nibh, aliquet id hendrerit id, scelerisque egestas odio.
                Fusce a erat orci. Sed vel diam metus.
            </p>
        </div>
    </div>
</div> 

<div>

</div>    

@endsection