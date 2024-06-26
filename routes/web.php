<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KokiController;
use App\Http\Controllers\KasirController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('home', [HomeController::class, 'home'])->name('home');
Route::post('actbooking', [HomeController::class, 'actbooking'])->name('actbooking');
Route::post('showdataorder', [HomeController::class, 'showdataorder'])->name('showdataorder');
Route::post('addcart', [HomeController::class, 'addcart'])->name('addcart');
Route::post('showprod', [HomeController::class, 'showprod'])->name('showprod');
Route::post('actcheckout', [HomeController::class, 'actcheckout'])->name('actcheckout');

// Login
Route::get('login', [AuthController::class, 'ShowFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login_post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
// End Login

Route::middleware(['auth'])->group(function () {

    Route::get('dasbor', [MainController::class, 'dasbor'])->name('dasbor');
    Route::post('showdatadashboard', [MainController::class, 'showdatadashboard'])->name('showdatadashboard');
    Route::post('showchartdashboard', [MainController::class, 'showchartdashboard'])->name('showchartdashboard');

    Route::middleware(['auth'],'role_id:1')->group(function () {
        Route::get('users', [AdminController::class, 'users'])->name('users');
        Route::get('category', [AdminController::class, 'category'])->name('category');
        Route::get('table', [AdminController::class, 'table'])->name('table');
        Route::get('product', [AdminController::class, 'product'])->name('product');
        Route::post('editproduct', [AdminController::class, 'editproduct'])->name('editproduct');
        Route::post('addtable', [AdminController::class, 'addtable'])->name('addtable');
        Route::post('edittable', [AdminController::class, 'edittable'])->name('edittable');
    });

    Route::middleware(['auth'],'role_id:2')->group(function () {

    });

    Route::middleware(['auth'],'role_id:3')->group(function () {
        Route::get('listpesanan', [KokiController::class, 'listpesanan'])->name('listpesanan');
        Route::post('actioncheklist', [KokiController::class, 'actioncheklist'])->name('actioncheklist');
        Route::post('actdoneorder', [KokiController::class, 'actdoneorder'])->name('actdoneorder');

    });

    Route::middleware(['auth'],'role_id:4')->group(function () {
        Route::get('pembayaran', [KasirController::class, 'pembayaran'])->name('pembayaran');
        Route::post('showprintorder', [KasirController::class, 'showprintorder'])->name('showprintorder');
        Route::post('endorder', [KasirController::class, 'endorder'])->name('endorder');

    });


    Route::post('upload_profile', [MainController::class, 'upload_profile'])->name('upload_profile');
    Route::post('actionshowdata', [MainController::class, 'actionshowdata'])->name('actionshowdata');
    Route::post('actionshowdatawmulti', [MainController::class, 'actionshowdatawmulti'])->name('actionshowdatawmulti');
    Route::post('actionlistdata', [MainController::class, 'actionlistdata'])->name('actionlistdata');
    Route::post('actionedit', [MainController::class, 'actionedit'])->name('actionedit');
    Route::post('actioneditwmulti', [MainController::class, 'actioneditwmulti'])->name('actioneditwmulti');
    Route::post('actiondelete', [MainController::class, 'actiondelete'])->name('actiondelete');
    Route::post('actionadd', [MainController::class, 'actionadd'])->name('actionadd');


});
