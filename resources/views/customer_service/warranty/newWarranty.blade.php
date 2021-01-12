@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="text-center pt-5 pb-5">Claim Warranty: {{ $items[0]->numSO }}</h1>
        <div class="row justify-content-center">
            <div class="col-md-12 pb-5">
                <div class="card" style="width: 100%;">
                    <div class="card-body pt-4">
                        <div class="modal-header">
                            <h2>Line Items Available</h2>
                        </div>
                        <form action="/warranty" method="POST">
                            @csrf
                            @foreach ($items as $item)
                                <div class="card" style="width: 100%;" id="lineItem">
                                    <div class="row pt-3">
                                        <div class="col-md-5 m-3">
                                            <img id="{{ $item->modelType }}-img" class="card-img-top"
                                                src="{{ asset($item->image) }}" alt="Card image cap">
                                        </div>
                                        <div class="col-md-5 m-2 info-item">
                                            <h1>{{ $item->name }}</h1>
                                            <h6 class="card-subtitle mb-2 text-muted">Model Type: {{ $item->modelType }}
                                            </h6>
                                            <p class="font-weight-bold m-1">Price: Rp
                                                {{ number_format($item->price, 2, ',', '.') }}
                                            </p>
                                            <p class="font-weight-bold m-1">Ammount: {{ $item->quantity }}</p>
                                            <p class="font-weight-bold m-1">Color: {{ $item->color }}</p>
                                            <p class="font-weight-bold m-1">Size: {{ $item->size }}</p>

                                            {{-- Informasi untuk klaim garansi
                                            --}}
                                            <div class="form-check">
                                                <input class="form-check-input warranty" type="checkbox"
                                                    value="{{ $item->modelType }}" name="item[]">
                                                <label class="form-check-label font-weight-bold m-1" for="warranty">
                                                    Claim Warranty
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-secondary buttonPurple">Add</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
