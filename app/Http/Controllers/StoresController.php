<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    //
    public function index() {
        $store = Store::all();
        return view('store.index',[
            'store' => $store
        ]);
    }
}
