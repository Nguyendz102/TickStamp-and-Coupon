@extends('layouts.app')
@section('content')
<h1 style="text-align: center">Store</h1>
<ol class="list-group list-group-numbered">
  
    {{-- <a style="width: 200px;" class="btn btn-primary" href="/app-create">Create a new App</a> --}}
    @foreach ($store as $item)
    <li class=" list-group-item d-flex justify-content-between align-items-start">
      <img style="width: 70px; height: 70px;"  class="img-thumbnail" alt="...">
      <div class="ms-2 me-auto">
        <div class="fw-bold">
            {{ $item -> name }}
        </div>
        <div>
          <a>Địa Chỉ: {{ $item -> address }}</a>
        </div>
        <div>
          <a>App: {{ $item -> app_id }}</a>
        </div>
      </div>
      <form action="/{{ $item -> id }}/edit"  >
        <button  type="submit" class="btn btn-success">Edit</button>
    </form>
      {{-- <a href="foods/{{ $item -> id }}/edit"> Edit Food</a> --}}
    </li>
    @endforeach
  </ol>
@endsection