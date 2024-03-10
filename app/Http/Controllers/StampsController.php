<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\ImageStamp;
use App\Models\Stamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StampsController extends Controller
{
    //
    public function index() {
        $stamp = Stamp::all();
        $image_stamp = ImageStamp::all();
     return view('stamps.index',compact('stamp','image_stamp'));
    }
    public function create(Request $request) {
        $user = Auth::user();
        $apps = $user->apps;
        $fullapp = App::all();
        $userInfo = $request->session()->get('user_info');
     return view('stamps.create',compact('userInfo','fullapp','apps'));
    }
    public function store(Request $request)
    {
        // dd('caasc');
        $request->validate([
            'maxstamp' => 'required',
            'status' => 'required',
            'app_id' => 'required',
            // Add more validation rul  es as needed
        ]);

        // $generatedImageName = $request->image->storeAs('images', 
        //  time() . '-' . $request->name . '.' 
        //  . $request->image->extension(), 'public');
        //  dd($generatedImageName) ;
        $app = Stamp::create([
            'maxstamp' => $request->input('maxstamp'),
            'one_stamp_per_day' => $request->input('status'),
            'app_id' => $request->input('app_id'), 
        ]);
        $app->save();
        return redirect('/stamps');
    }
    public function storeimage(Request $request)
    {
        try{
            for ($i = 0; $i < $request->input('maxstamp'); $i++) {
                // dd($request->input('maxstamp'), $i);
                $record = new ImageStamp();
                $record->before_image = $request->file('image-before.' . $i)->store('images','public');
                $record->after_image = $request->file('image-after.' . $i)->store('images','public');
                $record->post_stamp = $i + 1;
                $record->stamp_id = $request->input('stamp_id');
                // dd('Maxstamp:', $request->input('maxstamp'), 'Post_stamps:', range(1, $request->input('maxstamp')));
                $record->save();
            }
            return redirect('/stamps')->with('success', 'Dữ liệu đã được lưu.');
        }catch (\Exception $e) {
            // Báo cáo lỗi nếu có
            dd($e->getMessage());
        }
        
        // Lặp qua mảng image-before và image-after được gửi từ form    
        
    }
    

}
