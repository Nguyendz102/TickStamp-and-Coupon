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
                <div class="login100-form validate-form p-b-33 p-t-5" style="height: 500px; display: flex; flex-direction: column; margin: 0; padding: 0;">
                    <!-- Phần chứa hai nút chuyển trang -->
                    <div style="display: flex; justify-content: center; align-items: center; height: 50px; margin: 0; padding: 0;">
                        <button id="btn1" style="height: 50px; margin: 0; padding: 0;" class="full-width" onclick="showContent(1)">TickStamp</button>
                        <button id="btn2" style="height: 50px; margin: 0; padding: 0;" class="full-width" onclick="showContent(2)">List Coupon</button>
                    </div>
                    <!-- Hai phần nội dung khác nhau -->
                    <div style="display: flex; margin: 0; border-radius: 5%; padding: 0;">
                        <div id="content1" style="flex: 1; background-color: #ffff; margin: 0; padding: 0;">
                            @foreach ($imageStamps as $item)
                            @php
                                $found = false;
                                $after_image = null;
                            @endphp
                        
                            @foreach ($customerStamps as $customerStamp)
                                @if ($item->post_stamp == $customerStamp->count_stamp)
                                    @php
                                        $found = true;
                                        $after_image = $item->after_image;
                                        break;
                                    @endphp
                                @endif
                            @endforeach
                        
                            @if ($found)
                                <!-- Nếu có trùng khớp, sử dụng trường after_image -->
                                <img style="width: 50px; height: 50px; margin-right: 10px;border-radius: 100px; margin: 10px" src="{{ asset('storage/' . $after_image) }}" class="img-thumbnail" alt="After">
                            @else
                                <!-- Nếu không trùng khớp hoặc không có dữ liệu của customer_stamp, sử dụng trường before_image -->
                                <img style="width: 50px; height: 50px; margin-right: 10px;border-radius: 100px; margin: 10px" src="{{ asset('storage/' . $item->before_image) }}" class="img-thumbnail" alt="Before">
                            @endif
                        @endforeach
                        </div>
                        <div id="content2" style="flex: 1; background-color: #ffff; margin: 0; padding: 0; display: none;">
                            <p>Content 2</p>
                        </div>
                    </div>
                </div>
        </div>
    </div>
	<div id="dropDownSelect1"></div>
</body>
</html>
<script>
    // JavaScript để hiển thị nội dung content 1 khi trang được tải
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("content1").style.display = "block";
        document.getElementById("btn1").classList.add("active"); // Thêm lớp active cho nút Trang 1
    });

    // Hàm để hiển thị nội dung tương ứng với nút được nhấn và giữ lại vị trí của nút được nhấn
    function showContent(contentId) {
        if (contentId === 1) {
            document.getElementById("content1").style.display = "block";
            document.getElementById("content2").style.display = "none";
            document.getElementById("btn1").classList.add("active"); // Thêm lớp active cho nút Trang 1
            document.getElementById("btn2").classList.remove("active"); // Loại bỏ lớp active khỏi nút Trang 2
        } else if (contentId === 2) {
            document.getElementById("content1").style.display = "none";
            document.getElementById("content2").style.display = "block";
            document.getElementById("btn1").classList.remove("active"); // Loại bỏ lớp active khỏi nút Trang 1
            document.getElementById("btn2").classList.add("active"); // Thêm lớp active cho nút Trang 2
        }
    }
</script>