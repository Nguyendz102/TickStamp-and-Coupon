@extends('layouts.app')
@section('content')
<form method="POST" action="/" style="margin: 5%" enctype="multipart/form-data" >
    @csrf
    <label for="exampleInputPassword1" class="form-label">Choose file images</label>
    <input class="form-control" type="file" name="image">
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Name app</label>
      <input name="name" type="text" class="form-control" >
    </div>
    <div style="display: flex; ">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="1" value="1" checked>
            <label class="form-check-label" for="1">
              Hoạt Động
            </label>
          </div>
          <div class="form-check" style="margin-left: 100px">
            <input class="form-check-input" type="radio" name="status" id="0" value="0" >
            <label class="form-check-label" for="0">
              Không Hoạt Động
            </label>
          </div>
    </div>
    <div style="margin-top: 10px">
      <label>Choose a User</label>
      <select name="id_users">
          @foreach ($user as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
          @endforeach
      </select>
   </div>
    <button style="margin-top: 20px" type="submit" class="btn btn-primary">Submit</button>
  
  </form>
@endsection