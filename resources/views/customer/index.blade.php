<!DOCTYPE html>
<html lang="en">
<head>
	<title>Customer</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="storage/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
</head>
<body>
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
	<div class="limiter">
		<div class="container-login100" style="background-image: url('{{ URL::asset('storage/images/bg-01.jpg') }}');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					TickStamp
				</span>
				<form action="{{ route('addcustomer') }}" method="POST" class="login100-form validate-form p-b-33 p-t-5">
					@csrf
					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="name" placeholder="User name">
						<span class="focus-input100" ></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter phone number">
						<input class="input100" type="number" name="phone" placeholder="Phone Number">
						<span class="focus-input100" ></span>
					</div>
					{{-- <input class="input100" type="number" name="phone" placeholder="Phone Number"> --}}
					<div class="container-login100-form-btn m-t-32">
						<button style="submit" class="login100-form-btn">
							Tick
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	<div id="dropDownSelect1"></div>
</body>
</html>