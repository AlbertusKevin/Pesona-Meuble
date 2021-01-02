{{--
    Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
    Unauthorized copying of this file, via any medium is strictly prohibited
    Proprietary and confidential
    Code's Author by Chris Christian, Mikhael Adriel, December 2020 
--}}

@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="text-center pt-5 pb-5">Discount Detail</h1>
    <div class="row justify-content-center">
        <div class="col-6 pb-5">
            <div class="card" style="width: 100%;">
                <div class="card-body pt-4">
                    <div class="form-group row">
                        <label for="customerName" class="col-sm-4 col-form-label">Code Discount</label>
                        <div class="col-sm-8">
                            <label class="col-form-label font-weight-bold"> : {{$discount->code}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customerName" class="col-sm-4 col-form-label">Description</label>
                        <div class="col-sm-8">
                            <label class="col-form-label font-weight-bold"> : {{$discount->description}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customerName" class="col-sm-4 col-form-label">Discount</label>
                        <div class="col-sm-8">
                            <label class="col-form-label font-weight-bold"> : {{$discount->percentDisc*100 . '%'}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customerName" class="col-sm-4 col-form-label">Person in Charge</label>
                        <div class="col-sm-8">
                            <label class="col-form-label font-weight-bold"> : {{$discount->name}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customerName" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                            @if($discount->statusActive === 1)
                            <label class="col-form-label font-weight-bold"> : Active</label>
                            @else
                            <label class="col-form-label font-weight-bold"> : Expired</label>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customerName" class="col-sm-4 col-form-label">Valid From</label>
                        <div class="col-sm-8">
                            <label class="col-form-label font-weight-bold"> : {{$discount->from}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customerName" class="col-sm-4 col-form-label">Valid To</label>
                        <div class="col-sm-8">
                            <label class="col-form-label font-weight-bold"> : {{$discount->to}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customerName" class="col-sm-4 col-form-label">Discount For</label>
                        <div class="col-sm-8">
                            @if($discount->discountFor == 0)
                            <label class="col-form-label font-weight-bold"> : Meuble Discount</label>
                            @else
                            <label class="col-form-label font-weight-bold"> : Payment Discount</label>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($discount->statusActive === 1)
    <form action='/discount/{{$discount->code}}' method="POST">
        @method('PATCH')
        @csrf
        <div class="row justify-content-center">
            <button type="submit" class="btn btn-secondary buttonPurple">Update Status</button>
        </div>
    </form>
    @endif
</div>

@endsection