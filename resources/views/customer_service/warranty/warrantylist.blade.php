@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="text-center mt-5 mb-5 font-weight-bold">Warranty List</h1>
        </div>
        {{-- <div class="row justify-content-between">
            <div class="col-12 col-md-4">
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                </form>
            </div>
            <div class="col-12 col-md-5 text-right">
                <div class="row text-right justify-content-end">
                    <button type="button" name="" id="" class="defaultbtn btn btn-primary mr-2"> New</button>
                    <div class="dropdown">
                        <button class="btn btn-secondary defaultbtn dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sort
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Sort Opt1</a>
                            <a class="dropdown-item" href="#">Sort Opt2</a>
                            <a class="dropdown-item" href="#">Sort Opt3</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="row justify-content-between">
            <div class="col-12 col-md-12 text-right">
                <div class="row text-right justify-content-end">
                    <a href="/meuble/create" class="btn btn-primary mr-2" data-toggle="modal"
                        data-target="#exampleModal">Input Warranty</a>
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Invoice Number</th>
                        <th scope="col" class="text-center">Furniture Name</th>
                        <th scope="col" class="text-center">Qty</th>
                        <th scope="col" class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($warranties != null)
                        <tr class="trcard">
                            <th colspan="4" scope="row" class="text-center">
                                There is no warranty that must be processed
                            </th>
                        </tr>
                    @endif
                    @foreach ($warranties as $warranty)
                        <tr class="trcard">
                            <th scope="row">{{ $warranty->numSO }}</th>
                            <td class="text-center">{{ $warranty->modelType }}</td>
                            <td class="text-center">{{ $warranty->quantity }}</td>
                            <td class="text-center">
                                @if ($warranty->status == 0)
                                    Not Yet Reedemed
                                @else
                                    Reedemed
                                @endif
                            </td>
                        </tr>
                        <tr class="separator">
                            <th scope="row"></th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Warranty</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Invoice Number: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
