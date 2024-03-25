<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    //
    public function index($app_id)
    {
        Session::put('app_id', $app_id);

        return view('customer.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            // Thêm các quy tắc kiểm tra hợp lệ khác nếu cần
        ]);
    
        $appId = session('app_id');
        $customer = new Customer([
            'name' => $request->input('name'),
            'sdt' => $request->input('phone'),
        ]);
        
        // Lấy coupon tương ứng với app_id
        $coupon = Coupon::where('app_id', $appId)->first();
        if ($coupon) {
            $customer->coupon_id = $coupon->id;
            $customer->save();
        } else {
            Session::flash('toast_error', 'Không tìm thấy coupon tương ứng.');
        }
    
        return Redirect::to('/tickstamp');
    }

    public function tick()
    {
        return view('customer.tickstamp');
    }
}
