<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages/index');
});

Route::get('/admin/admin-book-add', function () {
    return view('pages/admin/admin-book-add');
});

Route::get('/admin/admin-book-edit-list', function () {
    return view('pages/admin/admin-book-edit-list');
});

Route::get('/admin/admin-book-edit', function () {
    return view('pages/admin/admin-book-edit');
});

Route::get('/order', function () {
    return view('pages/order/order');
});

Route::get('/shopping-cart', function () {
    return view('pages/order/shopping-cart');
});

Route::get('/thank-you', function () {
    return view('pages/order/thank-you');
});

Route::get('/products/category', function () {
    return view('pages/products/category');
});

Route::get('/products/product-detail', function () {
    return view('pages/products/product-detail');
});

Route::get('/forgot-password', function () {
    return view('pages/user-auth/forgot-password');
});

Route::get('/log-in', function () {
    return view('pages/user-auth/log-in');
});

Route::get('/registration', function () {
    return view('pages/user-auth/registration');
});
