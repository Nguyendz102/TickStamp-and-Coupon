<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    public function index(){
        $user = User::all();
        return view('users.index',[
            'user' => $user
        ]);
    }
    public function create(){
        return view('users.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required|confirmed',
        ]);
        $user = User::create([
            // dd(Hash::make('123456'))
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'status' => $request->input('status'),
            'role' => 1
        ]);
        $user->save();
        return redirect('/users');
    }
}
