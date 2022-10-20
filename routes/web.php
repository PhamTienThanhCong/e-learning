<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\authAdminController;
use App\Http\Controllers\homeViewController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\userController;
use App\Http\Middleware\AdminDontLogin;
use App\Http\Middleware\AdminWasLogin;
use App\Http\Middleware\UserWasLogin;
use App\Http\Middleware\SellerWasLogin;
use App\Http\Middleware\AdminSellerWasLogin;
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

// User
Route::get('/dang-nhap', [userController::class, 'login'])->name('user.login');
Route::post('/dang-nhap/xu-ly-dang-ky', [userController::class, 'register'])->name('user.register');
Route::post('/dang-nhap/xu-ly-dang-nhap', [userController::class, 'loginProcessing'])->name('user.loginProcessing');
Route::get('/tai-khoan-cua-toi/dang-xuat', [userController::class, 'logout'])->name('user.logout');

Route::group([
    'middleware' => UserWasLogin::class,
],function(){
    Route::get('/tai-khoan-cua-toi', [userController::class, 'myAccount'])->name('user.myAccount');
    Route::get('/khoa-hoc-cua-toi', [homeViewController::class , 'myCourse'])->name('home.myCourse');
    Route::post('/khoa-hoc/mua-khoa-hoc', [homeViewController::class, 'buyCourse'])->name('home.buyCourse');
    Route::post('/khoa-hoc/ma-{course_id}/danh-gia', [homeViewController::class, 'ratingCourse'])->name('home.ratingCourse');
    Route::get('/khoa-hoc/xem-khoa-{course_id}/bai-{lesson_id}', [homeViewController::class, 'learnCourse'])->name('home.learnCourse');
});

Route::get('/khoa-hoc', [homeViewController::class , 'course'])->name('home.course');

Route::get('/khoa-hoc/ma-{course_id}', [homeViewController::class , 'viewCourse'])->name('home.viewCourse');
Route::get('/khoa-hoc/ma-{course_id}/dat-hang', [homeViewController::class , 'orderCourse'])->name('home.orderCourse');
Route::get('/khoa-hoc/ma-{course_id}/huy-dat-hang', [homeViewController::class , 'unOrderCourse'])->name('home.unOrderCourse');

Route::get('/gio-hang', [homeViewController::class , 'myCart'])->name('home.myCart');

Route::get('/', [homeViewController::class , 'course'])->name('home.course');

// User