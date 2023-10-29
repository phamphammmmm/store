<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegisterAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;

//User
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    } else {
        return view('client.login');
    }
})->name('login');

Route::middleware('web')->group(function () {
    Route::get('/login', function () {
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('client.login');
        }
    })->name('login');

    Route::get('/register', function () {
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('client.register');
        }
    })->name('register');

    Route::middleware('auth')->group(function () {
        Route::get('/home', function () {
            return view('client.home');
        })->name('home');
    });
});


Route::get('/footer',[HomeController::class,'footer'])->name('footer');
Route::get('/header',[HomeController::class,'header'])->name('header');
Route::get('/home',[HomeController::class,'home'])->name('home');
Route::get('/about',[HomeController::class,'about'])->name('about');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/product',[ProductController::class,'product'])->name('product');
Route::get('/product1',[ProductController::class,'product1'])->name('product1');

Route::get('/brand',[BrandController::class,'brand'])->name('brand');

Route::get('/cart',[CartController::class,'cart'])->name('cart');
Route::delete('/cart/{cart_id}',[CartController::class,'delete'])->name('cart.delete');
Route::post('/cart/add/{product_id}',[CartController::class,'addToCart'])->name('cart.add');

//Admin
Route::get('/admin', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return view('login-admin');
    }
})->name('login-admin');

Route::middleware('web')->group(function () {
    Route::get('/login-admin', function () {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            return view('login-admin');
        }
    })->name('login-admin');

    Route::get('/register-admin', function () {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            return view('register-admin');
        }
    })->name('register-admin');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });
});

Route::post('/login-admin', [LoginAdminController::class, 'loginAdmin']);
Route::post('/register-admin', [RegisterAdminController::class, 'registerAdmin']);
Route::post('/logout-admin', [LoginAdminController::class, 'logout'])->name('logout-admin');
Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

Route::get('/order1',[OrderController::class, 'view1'])->name('order1');
Route::get('/order/{id}',[OrderController::class, 'view'])->name('order');
Route::post('/receipt/save',[ReceiptController::class, 'save'])->name('receipt.save');

Route::get('/brand/show',[BrandController::class,'show'])->name('brand.show');
Route::post('/brand/create',[BrandController::class,'create'])->name('brand.create');
Route::delete('/brand/{id}',[BrandController::class,'delete'])->name('brand.delete');

Route::get('/category/view', [CategoryController::class, 'view'])->name('category.view');
Route::get('/category/show', [CategoryController::class, 'show'])->name('category.show');
Route::post('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');

Route::get('/product/view',[ProductController::class,'view'])->name('product.view');
Route::get('/product/show',[ProductController::class,'show'])->name('product.show');
Route::post('/product/create',[ProductController::class,'create'])->name('product.create');
Route::delete('/product/{id}',[ProductController::class,'delete'])->name('product.delete');
Route::post('/product/update/{id}',[ProductController::class,'update'])->name('product.update');

Route::get('/manage', [ManageController::class,'index'])->name('manage');
Route::get('/manage/search', [ManageController::class, 'search'])->name('manage.search');
Route::post('/manage/create', [ManageController::class, 'create'])->name('manage.create');
Route::post('/manage/update', [ManageController::class, 'update'])->name('manage.update');
Route::delete('/manage/delete/{id}', [ManageController::class, 'delete'])->name('manage.delete');