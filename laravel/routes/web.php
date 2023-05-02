<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserAuthController;
use \App\Http\Controllers\SearchController;


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

Route::get('/admin-book-add', function () {
    return view('pages/admin/admin-book-add');
})->middleware('isLoggedIn');

Route::get('/admin-book-edit-list', function () {
    return view('pages/admin/admin-book-edit-list');
})->middleware('isLoggedIn')->name('admin-book-edit-list');

Route::get('/admin-book-edit', function () {
    return view('pages/admin/admin-book-edit');
})->middleware('isLoggedIn');

Route::get('/order', function () {
    return view('pages/order/order');
});

Route::get('/shopping-cart', [OrderController::class, 'ShoppingCartRoute']);

Route::get('/thank-you', function () {
    return view('pages/order/thank-you');
});

Route::get('/category', [ProductsController::class, 'CategoryRoute'])
    ->name('category');

Route::get('/product-detail', [ProductsController::class, 'ProductDetailRoute'])
    ->name('product-detail');

Route::get('/forgot-password', function () {
    return view('pages/user-auth/forgot-password');
});

Route::get('/log-in', [UserAuthController::class, 'login'])
    ->name('log-in');

Route::get('/registration', [UserAuthController::class, 'registration'])
    ->name('registration');

Route::post('register-user', [UserAuthController::class, 'registerUser'])
    ->name('register-user');

Route::post('login-user', [UserAuthController::class, 'loginUser'])
    ->name('login-user');

Route::get('logout-user', [UserAuthController::class, 'logoutUser'])
    ->name('logout-user');

Route::post('/saveBook', [AdminController::class, 'saveBook'])
    ->name('saveBook');

//Route::get('/search', [ProductsController::class, 'CategoryRoute'])
//    ->name('search');
