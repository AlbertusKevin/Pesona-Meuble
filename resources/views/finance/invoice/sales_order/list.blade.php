{{--
Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
Unauthorized copying of this file, via any medium is strictly prohibited
Proprietary and confidential
Code's Author by Albertus Kevin, Chris Christian, Mikhael Adriel December 2020
--}}

@extends('layouts.app')
@section('content')
    <div class="container">
        @include('message')
        <div class="row justify-content-center">
            <h1 class="text-center mt-5 mb-5 font-weight-bold">Invoices Of Sales Order</h1>
        </div>
        <div class="row pt-3">
            <div class="col-md-8 offset-md-2">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Num SO</th>
                            <th scope="col" class="text-center">Date</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    </tbody>
                    @foreach ($invoices as $invoice)
                        <tr class="separator">
                            <th scope="row"></th>
                        </tr>
                        <tr class="trcard">
                            <th scope="row" class="text-center"><a
                                    href='/salesorder/invoice/{{ $invoice->numSO }}'>{{ $invoice->numSO }}</a></th>
                            <td class="text-center">{{ $invoice->date }}</td>
                            <td class="text-center">
                                @if ($invoice->isSent == 0)
                                    Taken by Customer
                                @else
                                    @if ($invoice->isComplete == 0)
                                        <h5>
                                            <a href="/delivery/create/{{ $invoice->numSO }}" class="badge badge-primary">New
                                                Delivery</a>
                                        </h5>
                                        <form action="/delivery/complete/{{ $invoice->numSO }}" method="POST">
                                            @csrf
                                            @method("PATCH")
                                            <h5><button type="submit" class="badge badge-warning">Done Delivery</button>
                                            </h5>
                                        </form>
                                    @else
                                        Delivery Complete
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if (count($invoices) == 0)
                        <tr class="trcard">
                            <th class="text-center" colspan="5" scope="row">No invoice made yet</th>
                        </tr>
                        <tr class="separator">
                            <th colspan="2" scope="row"></th>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
