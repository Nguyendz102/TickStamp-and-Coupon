@extends('layouts.app')
@section('content')
<h1 style="text-align: center">Create Store to File</h1>
<form method="POST" action="{{ route('postdata') }}" style="margin: 5%" enctype="multipart/form-data" >
    @csrf
    {{-- <label  class="form-label">Choose file images</label>
    <input class="form-control" type="file" name="image"> --}}
    <div class="mb-3">
      <label  class="form-label">Choose File</label>
      <input class="form-control" type="file" name="csv_file" accept=".csv">
    </div>
      <div style="margin-top: 10px">
        <label>Choose an App</label>
        <select name="app_id">
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
    <button style="margin-top: 20px" type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection