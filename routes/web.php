<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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

route::Get('/',[HomeController::class,'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


route::Get('/redirect',[HomeController::class,'redirect'])->middleware('auth','verified');
route::Get('/category',[AdminController::class,'viewCategory'])->name('category');

route::POST('/add_category',[AdminController::class,'add_category'])->name('add.category');
route::get('/delete_category/{id}',[AdminController::class,'delete_category'])->name('delete.category');

route::get('/view_product',[AdminController::class,'view_product']);

route::POST('/add_product',[AdminController::class,'add_product'])->name('add.product');

route::get('/order',[AdminController::class,'order'])->name('order');

route::get('/show_product',[AdminController::class,'show_product']);

route::get('/delete_product/{id}',[AdminController::class,'delete_product']);

route::get('/update_product/{id}',[AdminController::class,'update_product']);
route::POST('/update_product_confirm/{id}',[AdminController::class,'update_product_confirm']);


route::POST('/search_order',[AdminController::class,'search_order']);

route::get('/delivered/{id}',[AdminController::class,'delivered']);
route::get('/print_pdf/{id}',[AdminController::class,'print_pdf']);

route::get('/send_email/{id}',[AdminController::class,'send_email']);
route::POST('/send_user_email/{id}',[AdminController::class,'send_user_email']);

route::get('/product_details/{id}',[HomeController::class,'product_details']);
route::POST('/add_cart/{id}',[HomeController::class,'add_cart'])->name('add_cart');

route::get('/show_cart',[HomeController::class,'show_cart']);
route::get('/remove_cart/{id}',[HomeController::class,'remove_cart']);
route::get('/cash_order',[HomeController::class,'cash_order']);
route::get('/stripe/{totalprice}',[HomeController::class,'stripe']);
route::post('stripe/{totalprice}',[HomeController::class,'stripePost'])->name('stripe.post');


route::POST('/add_comment',[HomeController::class,'add_comment'])->name('add_comment');
route::POST('/add_reply',[HomeController::class,'add_reply'])->name('add_reply');



