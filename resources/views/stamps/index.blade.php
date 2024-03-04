@extends('layouts.app')
@section('content')
<h1 style="text-align: center">Stamp Setting</h1>
<ol class="list-group list-group-numbered">
  <a style="width: 200px;" class="btn btn-primary" href="/create-stamp">Create a new Stamp</a>
    @foreach ($stamp as $item)
    <li class=" list-group-item d-flex justify-content-between align-items-start">
      <div class="ms-2 me-auto">
        <div class="fw-bold">
            {{ $item -> apps -> app_name }}
        </div>
        <div>
          <a>Max Stamp: {{ $item -> maxstamp }}</a>
        </div>
        <div>
                 <label >One Stamper Day:</label> 
                @if($item->one_stamp_per_day == 1)
                    <a style="color: green">True</a>
                @else
                <a style="color: red">Fails</a>
                @endif
        </div>
      </div>
     <!-- Button trigger modal -->
     <button type="button" class="btn btn-danger"   data-bs-toggle="modal" data-bs-target="#exampleModal">
      Upload Ảnh
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Image Stamp</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data" id="imageForm">
                      @csrf
                      @for ($i = 0; $i < $item->maxstamp; $i++)
                      <input type="hidden" value="{{ $item->maxstamp }}"  name="maxstamp" id="maxstamp">
                      <input type="hidden" value="{{ $item->id }}"  name="stamp_id" id="stamp_id">
                          <div style="display: flex; margin-top: 10px; margin-left: 5px">
                              <label style="margin-right: 5px" for="exampleInputPassword1" class="form-label">Before: </label>
                              <input class="form-control" type="file" name="image-before[{{ $i }}]">
  
                              <label style="margin-right: 5px" for="exampleInputPassword1" class="form-label">After: </label>
                              <input class="form-control" type="file" name="image-after[{{ $i }}]">
                          </div>
                      @endfor
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success" onclick="submitForm()">Save Image</button>
              </div>
              </form>
          </div>
      </div>
  </div>

      <!-- Button trigger modal -->
     
<button style="margin-left: 5px" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xemdl">
    Xem
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="xemdl" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Xem Ảnh</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @foreach ($image_stamp as $item)
            <div style="display: flex; margin-top: 10px; margin-left: 5px;justify-content: center">
                <label style="margin-right: 5px" for="exampleInputPassword1" class="form-label">Before: </label>
                <img style="width: 100px; height: 100px; margin-right: 500px" src="{{ asset('storage/' . $item->before_image) }}" class="img-thumbnail" alt="Before">
               
                <label style="margin-right: 5px" for="exampleInputPassword1" class="form-label">After: </label>
                <img style="width: 100px; height: 100px;" src="{{ asset('storage/' . $item->after_image) }}" class="img-thumbnail" alt="After">  
            </div>
           
            @endforeach
            {{-- <img style="width: 100px; height: 100px;" src="{{ asset('storage/'. $item->image) }}"  class="img-thumbnail" alt="..."> --}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
 

    <form style="margin-left: 5px" action="#"  >
        <button  type="submit" class="btn btn-primary">Edit</button>
    </form>
      {{-- <a href="foods/{{ $item -> id }}/edit"> Edit Food</a> --}}
    </li>
    @endforeach
  </ol>
  <script>
    function submitForm() {
        document.getElementById('imageForm').submit();
    }
</script>


@endsection
