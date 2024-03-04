@extends('layouts.app')
@section('content')
<h1 style="text-align: center">Create Stamps</h1>
<form method="POST" action="/stamps" style="margin: 5%" enctype="multipart/form-data" >
    @csrf
    {{-- <label  class="form-label">Choose file images</label>
    <input class="form-control" type="file" name="image"> --}}
    <div class="mb-3">
      <label  class="form-label">Max Stamp</label>
      <input name="maxstamp" type="number" class="form-control" >
    </div>
    <label >One Stamper Day</label>
    <div style="display: flex; margin-top: 10px ">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="1" value="1" checked>
            <label class="form-check-label" for="1">
             True
            </label>
          </div>
          <div class="form-check" style="margin-left: 100px">
            <input class="form-check-input" type="radio" name="status" id="0" value="0" >
            <label class="form-check-label" for="0">
              False
            </label>
          </div>
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