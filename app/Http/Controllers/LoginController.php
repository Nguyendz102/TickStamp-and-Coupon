<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }
//     public function login(Request $request)
// {
//     $credentials = $request->only('username', 'password');

//     if (Auth::attempt($credentials)) {
//         $user = Auth::user();

//         // Mã hóa mật khẩu trước khi lưu vào cookie
//         $hashedPassword = bcrypt($credentials['password']);

//         // Lưu thông tin đăng nhập vào cookie
//         $cookieValue = json_encode(['username' => $user->username, 'password' => $hashedPassword]);
//         $minutes = 24 * 60; // 1 ngày
//         $cookie = cookie('user_info', $cookieValue, $minutes);

//         // Gắn cookie vào response và chuyển hướng người dùng đến trang mong muốn
//         return redirect('/')->withCookie($cookie);
//     } else {
//         // Xử lý khi đăng nhập thất bại
//         return redirect('/login')->with('user', 'Thông tin đăng nhập không đúng');
//     }
// }

public function login(Request $request)
{
    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Lưu thông tin đăng nhập vào session
        $request->session()->put('user_info', [
            'username' => $user->username,
            'role' => $user->role,
        ]);

        // Chuyển hướng người dùng đến trang dashboard hoặc trang mong muốn
        return redirect('/home');
    } else {
        // Xử lý khi đăng nhập thất bại
        Session::flash('toast_error', 'Tài khoản hoặc mật khẩu không đúng');
        return redirect('/login');
    }
}


    public function logout()
    {
        Auth::logout();
        // Xóa cookie
        Cookie::queue(Cookie::forget('user_info'));
    
        // Chuyển hướng người dùng đến trang chủ hoặc trang nào đó
        
        return redirect('/login');
        
    }
}
