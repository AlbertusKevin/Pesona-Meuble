{{--
Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
Unauthorized copying of this file, via any medium is strictly prohibited
Proprietary and confidential
Code's Author by Albertus Kevin, January 2021
--}}

@extends('layouts.app')
@section('content')
    <div class="container">
        @include('message')
        <div class="row justify-content-center">
            <h1 class="text-center mt-5 mb-5 font-weight-bold">Meubles</h1>
        </div>
        <div class="row justify-content-between">
            <div class="col-12 col-md-12 text-right">
                <div class="row text-right justify-content-end">
                    <a href="/meuble/create" class="btn btn-primary mr-2">New</a>
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Model Type</th>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">Vendor</th>
                        <th scope="col" class="text-center">Stock</th>
                        <th scope="col" class="text-center">Price</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                </tbody>
                @foreach ($meubles as $meuble)
                    <tr class="separator">
                        <th scope="row"></th>
                    </tr>
                    @if ($meuble->stock < 4)
                        <tr class="trcard red-border">
                        @else
                        <tr class="trcard">
                    @endif
                    <th scope="row" class="text-center">
                        {{ $meuble->modelType }}
                    </th>
                    <td class="text-center">{{ $meuble->name }}</td>
                    <td class="text-center">{{ $meuble->vendor }}</td>
                    <td class="text-center">{{ $meuble->stock }}</td>
                    <td class="text-center">{{ $meuble->price }}</td>
                    <td class="text-center">
                        @if ($meuble->status == 1)
                            still on sale
                        @else
                            not for sale anymore
                        @endif
                    </td>
                    <td class="text-center">
                        <h5>
                            <a href="/meuble/{{ $meuble->modelType }}" class="badge badge-pill badge-info">Detail</a>
                        </h5>
                    </td>
                    </tr>
                    @if ($meuble->stock < 4)
        </div>
        @endif
        @endforeach
        @if (count($meubles) == 0)
            <tr class="trcard">
                <th class="text-center" colspan="5" scope="row">No meuble available yet</th>
            </tr>
            <tr class="separator">
                <th colspan="5" scope="row"></th>
            </tr>
        @endif
        </tbody>
        </table>
        <small class="text-muted mb-3"><sup>*</sup>Red border indicate the stock is running low</small>
    </div>
    </div>
@endsection
