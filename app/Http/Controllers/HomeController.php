<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function home()
    {
        return view('home');
    }
    public function index()
    {
        $app = App::all();
        $users = User::all();
        return view('index', compact('app', 'users'));
    }
    public function create()
    {
        $user = User::all();
        return view('create',[
            'user' =>$user
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
            'name' => 'required',
            'id_users' => 'required',
            // Add more validation rul  es as needed
        ]);

        $generatedImageName = $request->image->storeAs('images', 
         time() . '-' . $request->name . '.' 
         . $request->image->extension(), 'public');
        //  dd($generatedImageName) ;
        $app = App::create([
            'app_name' => $request->input('name'),
            'stamp_images' => $generatedImageName,
            'status' => $request->input('status'),
            'id_users' => $request->input('id_users'), 
        ]);
        $app->save();
        return redirect('/');
    }
    public function edit($id)
    {
        $user = User::all();
        $app = App::find($id);
        return view('edit',compact('app','user'));
    }
    public function update(Request $request, $id)
    {
        $generatedImageName = $request->image->storeAs('image' . time() 
        . '-' . $request->name . '.' 
        . $request->image->extension(), 'public');

         App::where('id', $id)
                         ->update([
                            'app_name' => $request->input('name'),
                            'stamp_images' => $generatedImageName,
                            'status' => $request->input('status'),
                            'id_users' => $request->input('id_users')
                         ]);
       return redirect('/');
    }

    //save to database


}
