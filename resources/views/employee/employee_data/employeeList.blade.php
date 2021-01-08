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
            <h1 class="text-center mt-5 mb-5 font-weight-bold">Employee List</h1>
        </div>
        <div class="row justify-content-between">
            <div class="col-12 col-md-12 text-right">
                <div class="row text-right justify-content-end">
                    <a class="defaultbtn btn btn-primary mr-2" href='/employee/create'>New</a>
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Role</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr class="separator">
                            <th scope="row"></th>
                        </tr>
                        <tr class="trcard ">
                            <th>{{ $employee->id }}</th>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->role }}</td>
                            <td>
                                @if ($employee->status == 0)
                                    resign
                                @else
                                    active
                                @endif

                            </td>
                            <td>
                                <h5>
                                    <a href='/employee/{{ $employee->id }}' class="badge badge-pill badge-info">Detail</a>
                                </h5>
                            </td>
                        </tr>
                    @endforeach
            </table>
        </div>
    </div>
@endsection
