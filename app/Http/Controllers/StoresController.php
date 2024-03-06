<?php

namespace App\Http\Controllers;

use App\Imports\StoreImport;
use App\Models\App;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class StoresController extends Controller
{
    //
    public function index() {
        $storepagi = Store::paginate(10); // Số lượng bản ghi trên mỗi trang là 10, bạn có thể thay đổi nếu cần
        return view('store.index',compact('storepagi'));
    }
    public function create(Request $request) {
       // Lấy thông tin người dùng hiện tại
    $user = Auth::user();
    // Lấy danh sách các ứng dụng mà người dùng quản lý
    $apps = $user->apps;
    $fullapp = App::all();
    $userInfo = $request->session()->get('user_info');
        return view('store.create',compact('apps','fullapp','userInfo'));
    }
    public function import(Request $request)
    {
        // dd($request->all());
        // Lấy file CSV từ request 
        Store::truncate();
        $file = request('csv_file');
        // Tạo một instance của StoreImport
        $storeImport = new StoreImport();
        // Set app_id từ dropdown
        $storeImport->setAppId($request->input('app_id'));
        // Import dữ liệu từ file CSV sử dụng StoreImport
        Excel::import($storeImport, $file);


        // Chuyển hướng hoặc trả về thông báo thành công
        return redirect('/stores');
    }
}
