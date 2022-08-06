<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use GuzzleHttp\Handler\Proxy;
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

    Route::resource('/cart', CartController::class);
    Route::get('/add-cart/{id}', [CartController::class, 'addCart'])->name('add-cart');

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

    Route::get('/tag/{tag}', [ProductController::class, 'tag']);
});

Route::middleware('userLogin')->prefix('/users')->group(function () {
    Route::get('login', [UserController::class, 'login'])->name('users.login');
    Route::post('login', [UserController::class, 'checkLogin'])->name('users.login');
});
Route::get('logout', [UserController::class, 'logout'])->name('users.logout');

Route::resource('users', UserController::class);
Route::resource('shop', ShopController::class);
// Admin client
Route::prefix('/admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.index');

    Route::get('/categories/status', [CategoryController::class, 'updateStatusCategory'])
        ->name('admin.updateStatusCategory');
    Route::get('/products/status', [ProductController::class, 'updateStatusProduct'])
        ->name('admin.updateStatusProduct');
    Route::get('/users/status', [UserController::class, 'updateStatusUser'])
        ->name('admin.updateStatusUser');

    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});
