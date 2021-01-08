{{--
Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
Unauthorized copying of this file, via any medium is strictly prohibited
Proprietary and confidential
Code's Author by Albertus Kevin, Chris Christian, December 2020
--}}

<div class="row justify-content-center">
    @if (session('failed_login'))
        <div class="alert alert-danger">
            {{ session('failed_login') }}
        </div>
    @endif
</div>

<div class="row justify-content-center">
    @if (session('success_new_meuble'))
        <div class="alert alert-success">
            {{ session('success_new_meuble') }}
        </div>
    @endif
</div>

<div class="row justify-content-center">
    @if (session('success_soft_delete_meuble'))
        <div class="alert alert-warning">
            {{ session('success_soft_delete_meuble') }}
        </div>
    @endif
</div>

<div class="row justify-content-center">
    @if (session('sale_again_meuble'))
        <div class="alert alert-success">
            {{ session('sale_again_meuble') }}
        </div>
    @endif
</div>

<div class="row justify-content-center">
    @if (session('success_po_0'))
        <div class="alert alert-success">
            {{ session('success_po_0') }}
        </div>
    @endif
</div>

<div class="row justify-content-center">
    @if (session('cancel_po'))
        <div class="alert alert-warning">
            {{ session('cancel_po') }}
        </div>
    @endif
</div>
@if ($message = Session::get('error'))
    <div class="alert alert-danger">
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Sorry, there is an error of the input. </strong>
        <br><br>
        <ul>
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif
