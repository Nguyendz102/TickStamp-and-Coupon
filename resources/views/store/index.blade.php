@extends('layouts.app')
@section('content')
<h1 style="text-align: center">Store</h1>
<a style="width: 200px; margin-bottom: 10px" class="btn btn-primary" href="/create-store">Create a new Store</a>
<ol class="list-group">
    @foreach ($storepagi as $item)
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <img style="width: 100px; height: 100px;" class="img-thumbnail" src="data:image/png;base64,{{ base64_encode(QrCode::format('png')->size(100)->generate(route('customer.index', ['app_id' => $item->app_id]))) }}" alt="QR Code">
            <div class="ms-2 me-auto">
                <div class="fw-bold">
                    {{ $item->name }}
                </div>
                <div>
                    <span>Địa Chỉ: {{ $item->address }}</span>
                </div>
                <div>
                    <span>App: {{ $item->apps->app_name }}</span>
                </div>
            </div>
        </li>
    @endforeach
</ol>
<!-- Hiển thị phân trang -->
<div class="d-flex justify-content-center">
  {{ $storepagi->onEachSide(1)->links('pagination::bootstrap-4') }}
</div>
<script>
    function redirectToCustomer(appId) {
        window.location.href = "/customer/" + appId;
    }
    </script>

@endsection