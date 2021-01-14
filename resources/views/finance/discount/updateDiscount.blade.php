@extends('layouts.app')

@section('content')
    <div class="container">
        @include('message')
        <h1 class="text-center pt-5 pb-5">Discount: {{ $discount->code }}</h1>
        <div class="row justify-content-center">
            <div class="col-6 pb-5">
                <div class="card" style="width: 100%;">
                    <form action="/discount/{{ $discount->code }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="card-body pt-4">
                            <div class="form-group row">
                                <label for="customerName" class="col-sm-4 col-form-label">Code Discount</label>
                                <div class="col-sm-8">
                                    <label class="col-form-label font-weight-bold"> : {{ $discount->code }}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-4 col-form-label">Description</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="description" name='description' rows="3"
                                        placeholder='Description'>{{ $discount->description }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="percentDisc" class="col-sm-4 col-form-label">Discount (%)</label>
                                <div class="col-sm-8">
                                    <input type="text" id='percentDisc' name='percentDisc' class="form-control"
                                        placeholder='Discount' value={{ $discount->percentDisc }}>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="customerName" class="col-sm-4 col-form-label">Person in Charge</label>
                                <div class="col-sm-8">
                                    <label class="col-form-label font-weight-bold"> : {{ $discount->name }}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="customerName" class="col-sm-4 col-form-label">Status</label>
                                <div class="col-sm-8">
                                    @if ($discount->statusActive === 1)
                                        <label class="col-form-label font-weight-bold"> : Active</label>
                                    @else
                                        <label class="col-form-label font-weight-bold"> : Expired</label>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="customerName" class="col-sm-4 col-form-label">Valid From</label>
                                <div class="col-sm-8">
                                    <label class="col-form-label font-weight-bold"> : {{ $discount->from }}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="customerName" class="col-sm-4 col-form-label">Valid To</label>
                                <div class="col-sm-8">
                                    <label class="col-form-label font-weight-bold"> : {{ $discount->to }}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="discFor" class="col-sm-4 col-form-label">Discount For:</label>
                                <div class="col-sm-8">
                                    <select id="discFor" name="discFor" class="form-control header-field-form">
                                        @if ($discount->discountFor == 0)
                                            <option value="0" selected>Meuble</option>
                                            <option value="1">Payment</option>
                                        @else
                                            <option value="0">Meuble</option>
                                            <option value="1" selected>Payment</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class=" btn discount">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- <div class="row justify-content-center">
            <button type="button" class="btn btn-secondary updatePost">Edit</button>
        </div>
        <div class="row justify-content-center pt-3">
            <a href="#" class="more">Back</a>
        </div> --}}
    </div>
    </div>

@endsection
