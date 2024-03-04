@extends('layouts.app')
@section('content')
<form method="POST" action="{{ route('addcoupon') }}" style="margin: 5%" enctype="multipart/form-data" >
    @csrf
    <label  class="form-label">Choose file images</label>
    <input class="form-control" type="file" name="image">
    <div class="mb-3">
      <label  class="form-label">Name Coupon</label>
      <input name="name" type="text" class="form-control" >
    </div>
    <div class="mb-3">
        <label  class="form-label">Descriptin Coupon</label>
        <input name="description" type="text" class="form-control" >
      </div>
      <div class="mb-3">
        <label  class="form-label">Note Coupon</label>
        <input name="note" type="text" class="form-control" >
      </div>
      <div class="mb-3">
        <label  class="form-label">MaxStamp</label>
        <input name="maxstamp" type="number" class="form-control" >
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