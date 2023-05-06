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

Route::get('/',[UserAuthController::class, 'index']);

Route::get('/admin-book-add', [AdminController::class, 'addBook'])
    ->middleware('isLoggedIn')
    ->name('admin-book-add');

Route::get('/admin-book-edit-list', [AdminController::class, 'listBooks'])
    ->middleware('isLoggedIn')
    ->name('admin-book-edit-list');

Route::get('/admin-book-edit/{id}', [AdminController::class, 'editBook'])
    ->middleware('isLoggedIn')
    ->name('editBook');

Route::delete('/admin-book-delete/{id}', [AdminController::class, 'deleteBook'])
    ->middleware('isLoggedIn')
    ->name('deleteBook');

Route::post('/saveBook', [AdminController::class, 'saveBook'])
    ->middleware('isLoggedIn')
    ->name('saveBook');

Route::post('/admin-book-edit/{id}', [AdminController::class, 'saveEditedBook'])
    ->middleware('isLoggedIn')
    ->name('saveEditedBook');


Route::get('/shopping-cart', [OrderController::class, 'ShoppingCartRoute']);
Route::post('/shopping-cart/{id}', [OrderController::class, 'ProductCount'])->name('shoppingCart.quantity');
Route::delete('/shopping-cart/{id}', [OrderController::class, 'DeleteProduct'])->name('shoppingCart.destroy');

Route::get('/order', [OrderController::class, 'OrderRoute']);
Route::post('/order', [OrderController::class, 'CompleteOrder'])->name('order.complete');

Route::get('/category', [ProductsController::class, 'CategoryRoute'])
    ->name('category');

Route::get('/product-detail', [ProductsController::class, 'ProductDetailRoute'])
    ->name('product-detail');
Route::post('/product-detail', [ProductsController::class, 'ProductDetailPostRoute'])
    ->name('product-detail-post');

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


//Route::get('/search', [ProductsController::class, 'CategoryRoute'])
//    ->name('search');
