<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Customer;
use App\Models\CustomerStamp;
use App\Models\ImageStamp;
use App\Models\Stamp;
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
        $phone = $request->input('phone');
        // Kiểm tra xem số điện thoại đã tồn tại trong bảng customer chưa
        $existingCustomer = Customer::where('sdt', $phone)->first();
        if ($existingCustomer) {
            // Lấy id của khách hàng từ bản ghi đã tồn tại
            $customerId = $existingCustomer->id;
            Session::put('customerId', $customerId);
        
            // Lấy bản ghi customer stamp cuối cùng của khách hàng
            $lastCustomerStamp = CustomerStamp::where('customer_id', $customerId)->latest()->first();
        
            // Tạo một bản ghi mới trong bảng CustomerStamp và tăng giá trị của trường count_stamp lên 1 so với bản ghi trước đó
            $newCustomerStamp = new CustomerStamp([
                'app_id' => $lastCustomerStamp->app_id, // Sử dụng các trường dữ liệu từ bản ghi trước
                'customer_id' => $customerId,
                'count_stamp' => $lastCustomerStamp->count_stamp + 1 // Tăng count_stamp lên 1 so với bản ghi trước đó
            ]);
            $newCustomerStamp->save();
        } else {
            // Nếu số điện thoại chưa tồn tại, tiếp tục thêm khách hàng mới vào bảng customer
            $appId = session('app_id');
            // Lấy coupon tương ứng với app_id
            $coupon = Coupon::where('app_id', $appId)->first();
            $stamp = Stamp::where('app_id', $appId)->first();
            $customer = new Customer([
                'name' => $request->input('name'),
                'sdt' => $phone,
                'coupon_id' => $coupon ? $coupon->id : null, // Kiểm tra nếu có coupon_id thì sử dụng, ngược lại để null
            ]);
            $customer->save(); // Lưu khách hàng vào cơ sở dữ liệu
        
            if ($coupon) {
                // Lấy id của khách hàng sau khi đã lưu
                $customerId = $customer->id;
                Session::put('customerId', $customerId);
                // Tạo một bản ghi trong bảng customer_stamp và sử dụng id của khách hàng
                $customerStamp = new CustomerStamp([
                    // Thêm các trường dữ liệu cho bảng customer_stamp
                    'app_id' => $stamp->app_id,
                    'customer_id' => $customerId,
                    'count_stamp' => 1
                    // Các trường dữ liệu khác nếu cần
                ]);
                $customerStamp->save();
            } else {
                Session::flash('toast_error', 'Không tìm thấy coupon tương ứng.');
            }
        }
    
        return redirect()->route('tickstamp');
    }

    public function tick()
{
     // Lấy danh sách các hình ảnh từ bảng image_stamp
     $imageStamps = ImageStamp::all();
    
     // Lấy thông tin của khách hàng và số stamp từ bảng customer_stamp
     $customerId = session('customerId');
     $customerStamps = CustomerStamp::where('customer_id', $customerId)->get();
 
     // Gửi dữ liệu tới giao diện
     return view('customer.tickstamp', compact('imageStamps', 'customerStamps'));
}
}
