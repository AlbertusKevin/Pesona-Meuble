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
    @if (session('success_po_0'))
    <div class="alert alert-success">
        {{ session('success_po_0') }}
    </div>
    @endif
</div>