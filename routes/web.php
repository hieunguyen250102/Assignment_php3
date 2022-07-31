<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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
// User client
Route::prefix('/')->group(function () {
    Route::get('/', function () {
        return view('client.index');
    })->name('client.index');
    Route::get('/shop', function () {
        return view('client.shop');
    });
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::get('/cart', function () {
        return view('client.cart');
    });
    Route::get('/empty-cart', function () {
        return view('client.empty-cart');
    });
    Route::get('/wishlist', function () {
        return view('client.wishlist');
    });
    Route::get('/compare', function () {
        return view('client.compare');
    });
    Route::get('/checkout', function () {
        return view('client.checkout');
    });
    Route::get('/account', function () {
        return view('client.account');
    });
    Route::get('/blogs', function () {
        return view('client.blogs');
    });
    Route::get('/blogs/{blog}', function () {
        return view('client.single-blog');
    });
    Route::get('/about', function () {
        return view('client.about');
    });
    Route::get('/contact', function () {
        return view('client.contact');
    });
});

Route::post('users/login', [UserController::class, 'checkLogin'])->name('users.login');
Route::get('users/logout', [UserController::class, 'logout'])->name('users.logout');

Route::resource('users', UserController::class);

// Admin client
Route::prefix('/admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.index');

    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);

    // Route::resources([
    //     'categories' => 'CategoriesController',
    //     'products' => 'ProductController'
    // ]);
});
