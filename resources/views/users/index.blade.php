@extends('layouts.app')
@section('content')

<h1 style="text-align: center">User</h1>
<ol class="list-group list-group-numbered">
    <a style="width: 200px;" class="btn btn-primary" href="/users/create">Create a new User</a>
    @foreach ($user as $item)
    <li class=" list-group-item d-flex justify-content-between align-items-start">
      <div class="ms-2 me-auto">
        <div class="fw-bold">
            {{ $item -> name }}
        </div>
        @if ( $item -> status == 1)
            <a style="color: green">Hoạt động</a>
        @else
        <a style="color: red">Không hoạt động</a>
        @endif
      </div>
      <form action="#"  >
        <button  type="submit" class="btn btn-success">Edit</button>
    </form>
      {{-- <a href="foods/{{ $item -> id }}/edit"> Edit Food</a> --}}
    </li>
    @endforeach
  </ol>
@endsection