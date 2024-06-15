<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('home', [HomeController::class, 'home'])->name('home');

// Login
Route::get('login', [AuthController::class, 'ShowFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login_post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
// End Login

Route::middleware(['auth'])->group(function () {

    Route::get('dasbor', [MainController::class, 'dasbor'])->name('dasbor');

    Route::middleware(['auth'],'role_id:1')->group(function () {
        Route::get('users', [AdminController::class, 'users'])->name('users');
        Route::get('category', [AdminController::class, 'category'])->name('category');
        Route::get('table', [AdminController::class, 'table'])->name('table');
        Route::get('product', [AdminController::class, 'product'])->name('product');
        Route::post('addtable', [AdminController::class, 'addtable'])->name('addtable');
        Route::post('edittable', [AdminController::class, 'edittable'])->name('edittable');
    });

    Route::middleware(['auth'],'role_id:2')->group(function () {

    });

    Route::middleware(['auth'],'role_id:3')->group(function () {

    });

    Route::middleware(['auth'],'role_id:4')->group(function () {

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
