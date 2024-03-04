<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponsController extends Controller
{
    //
    public function index() {
        $coupon = Coupon::all();
        return view('coupon.index',[
            'coupon' => $coupon
        ]);
    }
    public function create(Request $request) {
   // Lấy thông tin người dùng hiện tại
   $user = Auth::user();

   // Lấy danh sách các ứng dụng mà người dùng quản lý
   $apps = $user->apps;
   $fullapp = App::all();
   $userInfo = $request->session()->get('user_info');

   return view('coupon.create',compact('apps','fullapp','userInfo'));
    }
    
    public function store(Request $request)
    {
        // dd('caasc');
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
            'name' => 'required',
            'description' => 'required',
            'note' => 'required',
            'maxstamp' => 'required',
            // Add more validation rul  es as needed
        ]);

        $generatedImageName = $request->image->storeAs('images', 
         time() . '-' . $request->name . '.' 
         . $request->image->extension(), 'public');
        //  dd($generatedImageName) ;
        $app = Coupon::create([
            'name' => $request->input('name'),
            'image' => $generatedImageName,
            'description' => $request->input('description'),
            'note' => $request->input('note'),
            'count' => $request->input('maxstamp'),
            'app_id' => $request->input('app_id'), 
        ]);
        $app->save();
        return redirect('/coupons');
    }
}
