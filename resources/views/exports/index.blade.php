@extends('layouts.app')
@section('content')
<h1 style="text-align: center">Export Data Coupon</h1>
<div class="container mt-5">
    <form action="{{ route('exportCouponData') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="ngay" class="form-label">Chọn ngày:</label>
        <input type="date" class="form-control" id="ngay" name="ngay">
      </div>

      <div class="mb-3">
        <label for="app_id" class="form-label">Chọn App:</label>
        <select class="form-select" style="width: 200px;" id="app_id" name="app_id">
          @if ($userInfo['role'] == 0)
            @foreach ($fullapp as $item)
              <option value="{{ $item->id }}">{{ $item->app_name }}</option>
            @endforeach
          @else
            @foreach ($apps as $item)
              <option value="{{ $item->id }}">{{ $item->app_name }}</option>
            @endforeach
          @endif
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Gửi</button>
    </form>
  </div>


@endsection