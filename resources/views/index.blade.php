@extends('layouts.app')
@section('content')
<h1 style="text-align: center">APP</h1>
<ol class="list-group list-group-numbered">
    <a style="width: 200px;" class="btn btn-primary" href="/app-create">Create a new App</a>
    @foreach ($app as $item)
    <li class=" list-group-item d-flex justify-content-between align-items-start">
      <img style="width: 50px; height: 50px;" src="{{ asset('storage/'. $item->stamp_images) }}" class="img-thumbnail" alt="...">
      <div class="ms-2 me-auto">
        <div class="fw-bold">
            {{ $item -> app_name }}
        </div>
        <a>{{ $item -> user -> name }}</a>
        
        @if ( $item -> status == 1)
          : <a style="color: green">Hoạt động</a>
        @else
         :  <a style="color: red">Không hoạt động</a>
        @endif
        
      </div>
      <form action="/{{ $item -> id }}/edit"  >
        <button  type="submit" class="btn btn-success">Edit</button>
    </form>
      {{-- <a href="foods/{{ $item -> id }}/edit"> Edit Food</a> --}}
    </li>
    @endforeach
  </ol>
@endsection
   
