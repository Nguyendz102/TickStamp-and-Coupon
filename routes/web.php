<?php

use App\Http\Controllers\CouponsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StampsController;
use App\Http\Controllers\StoresController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/home',[
    HomeController::class,
    'home'
]);

Route::get('/',[
    HomeController::class,
    'index'
])->middleware('checkRole'); // Vai trò admin có giá trị 0 mới vào được các router cho phép;

Route::get('/app-create',[
    HomeController::class,
    'create'
])->middleware('checkRole');

Route::post('/',[
    HomeController::class,
    'store'
])->middleware('checkRole');

Route::get('/{id}/edit',[
    HomeController::class,
    'edit'
])->middleware('checkRole');

Route::put('/{id}/edit',[
    HomeController::class,
    'update'
])->middleware('checkRole');
//      User
Route::get('/users',[
    UsersController::class,
    'index'
])->middleware('checkRole');

Route::get('/users/create',[
    UsersController::class,
    'create'
])->middleware('checkRole');

Route::post('/users',[
    UsersController::class,
    'store'
])->middleware('checkRole');

// Login
Route::get('/login',[
    LoginController::class,
    'index'
]);
Route::post('/login',[
    LoginController::class,
    'login'
]);
// Đặt đường dẫn /logout cho việc đăng xuất
Route::get('/logout', [
    LoginController::class,
    'logout'
]);
// Stamp
Route::get('/stamps', [
    StampsController::class,
    'index'
]);
Route::get('/create-stamp', [
    StampsController::class,
    'create'
]);
Route::post('/stamps', [
    StampsController::class,
    'store'
])->name('addstamps');

Route::post('/stamps', [
    StampsController::class,
    'storeimage'
])->name('upload');

//Coupon
Route::get('/coupons', [
    CouponsController::class,
    'index'
]);
Route::post('/coupons', [
    CouponsController::class,
    'store'
])->name('addcoupon');

Route::get('/create-coupon', [
    CouponsController::class,
    'create'
]);


//Store
Route::get('/stores', [
    StoresController::class, 
    'index'
]);
Route::get('/create-store', [
    StoresController::class, 
    'create'
]);
Route::post('/stores', [
    StoresController::class, 
    'import'
])->name('postdata');

