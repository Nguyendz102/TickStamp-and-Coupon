@extends('layouts.app')
@section('content')
<h1 style="text-align: center">Coupon</h1>
<ol class="list-group list-group-numbered">
  <a style="width: 200px;" class="btn btn-primary" href="/create-coupon">Create a new Coupon</a>
    @foreach ($coupon as $item)
    <li class=" list-group-item d-flex justify-content-between align-items-start">
      <img style="width: 100px; height: 100px;" src="{{ asset('storage/'. $item->image) }}"  class="img-thumbnail" alt="...">
      <div class="ms-2 me-auto">
        <div class="fw-bold">
            {{ $item -> name }}
        </div>
        <div>
          <a>Giới Thiệu: {{ $item -> description }}</a>
        </div>
        <div>
          <a>Lưu Ý: {{ $item -> note }}</a>
        </div>
        <div>
          <a>Số stamp cần tích để nhận: {{ $item -> count }}</a>
        </div>
        
      </div>
      <form action="#"  >
        <button  type="submit" class="btn btn-success">Edit</button>
    </form>
      {{-- <a href="foods/{{ $item -> id }}/edit"> Edit Food</a> --}}
    </li>
    @endforeach
  </ol>
@endsection
   
