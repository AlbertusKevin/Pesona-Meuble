{{--
Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
Unauthorized copying of this file, via any medium is strictly prohibited
Proprietary and confidential
Code's Author by Chris Christian, Mikhael Adriel, December 2020
--}}

@extends('layouts.app')
@section('content')
    <div class="container">
        @include('message')
        <div class="row justify-content-center">
            <h1 class="text-center mt-5 mb-5 font-weight-bold">Customer List</h1>
        </div>
        <div class="row">
            <div class="col-md-2 offset-md-8">
                <div class="row text-right justify-content-end">
                    <a href="/customer/create" type="button" name="" id="" class="defaultbtn btn btn-primary mr-2">New</a>
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-8 offset-md-2 text-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->name }}</td>
                                <td class="text-center">
                                    <h5><a href="/customer/{{ $customer->id }}" class="badge badge-info">Detail</a></h5>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
