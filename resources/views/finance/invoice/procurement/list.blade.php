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
            <h1 class="text-center mt-5 mb-5 font-weight-bold">Invoices Of Purchase Order</h1>
        </div>
        <div class="row pt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Num PO</th>
                        <th scope="col" class="text-center">Received Status</th>
                        <th scope="col" class="text-center">Date</th>
                        <th scope="col" class="text-center">Confirm</th>
                    </tr>
                </thead>
                </tbody>
                @if (count($invoices) == 0)
                    <tr class="trcard">
                        <th class="text-center" colspan="5" scope="row">No invoice made yet</th>
                    </tr>
                    <tr class="separator">
                        <th colspan="3" scope="row"></th>
                    </tr>
                @endif
                @foreach ($invoices as $invoice)
                    <tr class="separator">
                        <th scope="row"></th>
                    </tr>
                    <tr class="trcard">
                        <th scope="row" class="text-center">
                            <a href='/procurement/invoice/{{ $invoice->numPO }}'>{{ $invoice->numPO }}</a>
                        </th>
                        @if ($invoice->receivedStatus == 0)
                            <td class="text-center">Not Received Yet</td>
                        @else
                            <td class="text-center">Received</td>
                        @endif
                        <td class="text-center">{{ $invoice->date }}</td>
                        @if ($invoice->receivedStatus == 0)
                            <td class="text-center">
                                <form action="/procurement/invoice/{{ $invoice->numPO }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                </form>
                            </td>
                        @else
                            <td class="text-center"><a disabled class="btn btn-success">Confirmed</a></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
