@extends('layouts.app')
@section('content')
<form method="POST" action="/users" style="margin: 4%" >
    @csrf
    <h2>Create New User</h2>
    <div class="mb-3">
      <label  class="form-label">Name</label>
      <input name="name" type="text" class="form-control" >
    </div>
    <div class="mb-3">
      <label  class="form-label">User Name</label>
      <input name="username" type="text" class="form-control" >
    </div>
    <div class="mb-3">
        <label  class="form-label">Password</label>
        <input name="password" type="password" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label  class="form-label">Confirm Password</label>
        <input name="password_confirmation" type="password" class="form-control" required>
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
    
    <button style="margin-top: 20px" type="submit" class="btn btn-primary">Submit</button>
  
  </form>
@endsection