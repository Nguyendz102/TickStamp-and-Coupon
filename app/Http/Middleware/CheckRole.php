<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class CheckRole
{
    public function handle(Request $request, Closure $next)
    {
        
        // Lấy thông tin từ session
        $userInfo = $request->session()->get('user_info');

        // Kiểm tra xem vai trò có phù hợp không
        if ($userInfo && $userInfo['role'] == 0) {
            return $next($request);
        }

        // Nếu không đúng vai trò, chuyển hướng hoặc trả lỗi 403
        Session::flash('toast_error', 'Bạn không có quyền truy cập.');
        return redirect('/home');
    }
}
