@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="text-center pt-5 pb-5">Sales Order {{$salesorder->numSO}}</h1>
    <div class="row justify-content-center">
        <div class="col-6 pb-5">
            <div class="card" style="width: 100%;">
                <div class="card-body pt-4">
                    <form>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Sales Order Number : </label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{$salesorder->numSO}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Responsible Employee :</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{$salesorder->responsibleEmployee}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Customer :</label>
                            <div class="col-sm-8">
                            <label class="col-form-label font-weight-bold">{{$salesorder->customer}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Date :</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{$salesorder->date}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Valid to :</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{$salesorder->validTo}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Transaction Status :</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{$salesorder->transactionStatus}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Total Item :</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{$salesorder->totalItem}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Total Meuble Discount :</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{$salesorder->totalMeubleDiscount}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Total Price :</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{$salesorder->totalPrice}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Discount Payment :</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{$salesorder->paymentDiscount}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Total Discount :</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{$salesorder->totalDiscount}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customerName" class="col-sm-4 col-form-label">Total Payment :</label>
                            <div class="col-sm-8">
                                <label class="col-form-label font-weight-bold">{{$salesorder->totalPayment}}</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection