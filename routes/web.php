<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\UserAddressesController;
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
//访问到pages控制器的root方法
Route::get('/',[PagesController::class,'root'])->name('root');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/email_verify_notice', [PagesController::class,'emailVerifyNotice'])->name('email_verify_notice');
    Route::get('/email_verification/verify', [EmailVerificationController::class,'verify'])->name('email_verification.verify');
    Route::get('/email_verification/send',[EmailVerificationController::class,'send'])->name('email_verification.send');

    Route::group(['middleware' => 'email_verified'], function() {
        Route::get('user_addresses',[UserAddressesController::class,'index'])->name('user_addresses.index');


    });

});
//测试数据填充
Route::get('/testDatabase',[UserAddressesController::class,'testDatabase']);