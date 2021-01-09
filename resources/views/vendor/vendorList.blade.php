{{--
Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
Unauthorized copying of this file, via any medium is strictly prohibited
Proprietary and confidential
Code's Author by Chris Christian, December 2020
--}}

@extends('layouts.app')
@section('content')
    <div class="container">
        @include('message')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center mt-5 mb-5 font-weight-bold">Vendor List</h1>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-12 col-md-11 text-right">
                <div class="row text-right justify-content-end">
                    <a class="defaultbtn btn btn-primary mr-2" href='/vendor/create'>New</a>
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-10 offset-md-1">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Company Code</th>
                            <th scope="col" class="text-center">Name</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendors as $vendor)
                            <tr class="separator">
                                <th scope="row"></th>
                            </tr>
                            <tr class="trcard">
                                <th class="text-center">{{ $vendor->companyCode }}</th>
                                <td class="text-center">{{ $vendor->name }}</td>
                                </td>
                                <td class="text-center">
                                    @if ($vendor->status == 0)
                                        not cooperating
                                    @else
                                        cooperating
                                    @endif
                                </td>
                                <td class="text-center">
                                    <h5>
                                        <a href="/vendor/{{ $vendor->companyCode }}" class="badge badge-info">detail</a>
                                    </h5>
                                </td>
                            </tr>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
