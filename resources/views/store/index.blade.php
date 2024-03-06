@extends('layouts.app')
@section('content')
<h1 style="text-align: center">Store</h1>
<a style="width: 200px; margin-bottom: 10px" class="btn btn-primary" href="/create-store">Create a new Store</a>
<ol class="list-group list-group-numbered">
  {{-- Hiển thị danh sách cửa hàng --}}
  @foreach ($storepagi as $item)
      <li class="list-group-item d-flex justify-content-between align-items-start">
          <img style="width: 70px; height: 70px;" class="img-thumbnail" alt="...">
          <div class="ms-2 me-auto">
              <div class="fw-bold">
                  {{ $item->name }}
              </div>
              <div>
                  <a>Địa Chỉ: {{ $item->address }}</a>
              </div>
              <div>
                  <a>App: {{ $item -> apps -> app_name }}</a>
              </div>
          </div>
              {{-- <button type="submit" class="btn btn-success">Edit</button> --}}
      </li>
  @endforeach
</ol>

<!-- Hiển thị phân trang -->
<div class="d-flex justify-content-center">
  {{ $storepagi->onEachSide(1)->links('pagination::bootstrap-4') }}
</div>

@endsection