<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\HomeController;
use App\Models\Comment;
use App\Models\Product;
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

Route::get('/', [HomeController::class,'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



Route::controller(adminController::class)->group(function(){
    Route::get('/view_category','view_category')->name('view_category');
    Route::post('/add_category','add_category')->name('add_category');
    Route::get('/delete_category/{id}','delete_category')->name('delete_category');
    Route::get('/view_product','view_product')->name('view_product');
    Route::post('/add_product','add_product')->name('add_product');
    Route::get('/show_product','show_product')->name('show_product');
    Route::get('/delete_product/{id}/{photoName}','delete_product')->name('delete_product');
    Route::get('/show_to_update/{id}','show_to_update')->name('show_to_update');
    Route::post('/update_product/{id}/{old_image}','update_product')->name('update_product');
    Route::get('/show_order','show_order')->name('show_order');
    Route::get('/delivered/{id}','delivered')->name('delivered');
    Route::get('/print_pdf/{id}','print_pdf')->name('print_pdf');
    Route::get('/search_on_data','search_on_data')->name('search_on_data');

});



Route::controller(HomeController::class)->group(function(){
    Route::get('/redirect','redirect')->name('redirect')->middleware('auth','verified');
    Route::get('/product_details/{id}','product_details')->name('product_details');
    Route::post('/add_to_cart/{id}','add_to_cart')->name('add_to_cart');
    Route::get('/show_cart','show_cart')->name('show_cart');
    Route::get('/delete_from_cart/{id}','delete_from_cart')->name('delete_from_cart');
    Route::get('/cash_on_delivery','cash_on_delivery')->name('cash_on_delivery');
    Route::get('stripeGet/{totalPrice}','stripe')->name('stripeGet');
    Route::post('stripe/{totalPrice}', 'stripePost')->name('stripe.post');
    Route::get('/show_my_orders','show_my_orders')->name('show_my_orders');
    Route::get('/cancel_order/{id}','cancel_order')->name('cancel_order');
    Route::post('/add_comment','add_comment')->name('add_comment');
    Route::post('/add_reply','add_reply')->name('add_reply');
    Route::post('/search_product','search_product')->name('search_product');
    Route::get('/show_all_products', 'show_all_products')->name('show_all_products');

});








