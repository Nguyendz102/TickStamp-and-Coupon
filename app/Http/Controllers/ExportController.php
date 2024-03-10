<?php

namespace App\Http\Controllers;

use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ExportController extends Controller
{
    //
    public function index(Request $request) {
        $user = Auth::user();
        // Lấy danh sách các ứng dụng mà người dùng quản lý
        $apps = $user->apps;
        $fullapp = App::all();
        $userInfo = $request->session()->get('user_info');
            return view('exports.index',compact('apps','fullapp','userInfo'));
    }

    public function exportCouponData(Request $request)
    {
        $exportDate = $request->input('ngay');
        $exportDateFormatted = date('Ymd', strtotime($exportDate));

        // Truy vấn cơ sở dữ liệu để lấy thông tin từ nhiều bảng
        $couponData = DB::table('customer_coupon')
            ->join('coupon', 'customer_coupon.app_id', '=', 'coupon.app_id')
            ->join('customer', 'customer_coupon.customer_id', '=', 'customer.id')
            ->select('coupon.name as ten_coupon', 'customer.sdt as so_dien_thoai', 'customer_coupon.created_at as ngay_nhan_coupon')
            ->whereDate('customer_coupon.created_at', $exportDate)
            ->get();

        // Tạo nội dung CSV
        $csvContent = "Tên coupon,Số điện thoại,Ngày nhận coupon\n";
        foreach ($couponData as $row) {
            $csvContent .= "{$row->ten_coupon},{$row->so_dien_thoai},{$row->ngay_nhan_coupon}\n";
        }

        // Tạo tên file theo định dạng YYYMMDD_sent_coupon.csv
        $fileName = $exportDateFormatted . '_sent_coupon.csv';

        // Tạo đối tượng Response để trả về file CSV
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=' . $fileName,
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate',
            'Expires' => '0',
        );

        return Response::make($csvContent, 200, $headers);
    }
}
