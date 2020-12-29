<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\UserAddressesController;
use App\Http\Controllers\ProductsController;
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
Route::get('products',[ProductsController::class,'index'])->name('products.index');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/email_verify_notice', [PagesController::class,'emailVerifyNotice'])->name('email_verify_notice');
    Route::get('/email_verification/verify', [EmailVerificationController::class,'verify'])->name('email_verification.verify');
    Route::get('/email_verification/send',[EmailVerificationController::class,'send'])->name('email_verification.send');

    Route::group(['middleware' => 'email_verified'], function() {
        Route::get('user_addresses',[UserAddressesController::class,'index'])->name('user_addresses.index');
        Route::get('user_addresses/create',[UserAddressesController::class,'create'])->name('user_addresses.create');
        Route::post('user_addresses',[UserAddressesController::class,'store'])->name('user_addresses.store');
        Route::get('user_addresses/{user_address}',[UserAddressesController::class,'edit'])->name('user_addresses.edit');
        Route::put('user_addresses/{user_address}',[UserAddressesController::class,'update'])->name('user_addresses.update');
        Route::delete('user_addresses/{user_address}',[UserAddressesController::class,'destroy'])->name('user_addresses.destroy');
        Route::post('products/{product}/favorite',[ProductsController::class,'favor'])->name('products.favor');
        Route::delete('products/{product}/favorite',[ProductsController::class,'disfavor'])->name('products.disfavor');
        Route::get('products/favorites',[ProductsController::class,'favorites'])->name('products.favorites');
        Route::get('products/{product}',[ProductsController::class,'show'])->name('products.show');
    });

});
//测试数据填充
Route::get('/testDatabase',[UserAddressesController::class,'testDatabase']);