@extends('layouts.app')
@section('content')
@if(session('toast_error'))
<script>
    // Hiển thị toast thông báo lỗi
    Toastify({
        text: "{{ session('toast_error') }}",
        duration: 3000,
        gravity: "top",
        position: "right",
        backgroundColor: "#ff6666",
        stopOnFocus: true,
    }).showToast();
</script>
@endif
<img src="{{ asset ('storage/images/okok.png') }}" 
width="100%"
height="80%"
alt="">
@endsection