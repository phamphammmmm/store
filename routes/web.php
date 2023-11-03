<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ContactController;
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

Route::get('/cart',[CartController::class,'cart'])->name('cart');
Route::get('/home',[HomeController::class,'home'])->name('home');
Route::get('/about',[HomeController::class,'about'])->name('about');
Route::get('/footer',[HomeController::class,'footer'])->name('footer');
Route::get('/header',[HomeController::class,'header'])->name('header');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/brand',[BrandController::class,'brand'])->name('brand');
Route::get('/product',[ProductController::class,'product'])->name('product');
Route::post('/cart/add',[CartController::class,'add'])->name('cart.add');
Route::delete('/cart/delete/{id}',[CartController::class,'delete'])->name('cart.delete');
Route::post('/contact/create', [ContactController::class,'create'])->name('contact.create');

//Admin
Route::get('/admin', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return view('client.login');
    }
})->name('login-admin');

Route::middleware('web')->group(function () {
    Route::get('/login-admin', function () {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            return view('client.login');
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

Route::get('/order/{id}',[OrderController::class, 'view'])->name('order');
Route::post('/receipt/save',[ReceiptController::class, 'save'])->name('receipt.save');

Route::get('/contact/show', [ContactController::class,'show'])->name('contact.show');
Route::delete('/contact/delete/{id}', [ContactController::class, 'delete'])->name('contact.delete');

Route::get('/brand/view',[BrandController::class, 'view'])->name('brand.view');
Route::get('/brand/show',[BrandController::class, 'show'])->name('brand.show');
Route::post('/brand/create',[BrandController::class,'create'])->name('brand.create');
Route::post('/brand/update', [BrandController::class, 'update'])->name('brand.update');
Route::delete('/brand/delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');

Route::get('/category/view', [CategoryController::class, 'view'])->name('category.view');
Route::get('/category/show', [CategoryController::class, 'show'])->name('category.show');
Route::post('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

Route::get('/product/view',[ProductController::class,'view'])->name('product.view');
Route::get('/product/show',[ProductController::class,'show'])->name('product.show');
Route::post('/product/create',[ProductController::class,'create'])->name('product.create');
Route::delete('/product/delete/{id}',[ProductController::class,'delete'])->name('product.delete');
Route::post('/product/update/{id}',[ProductController::class,'update'])->name('product.update');

Route::get('/manage', [ManageController::class,'index'])->name('manage');
Route::get('/manage/search', [ManageController::class, 'search'])->name('manage.search');
Route::post('/manage/create', [ManageController::class, 'create'])->name('manage.create');
Route::post('/manage/update', [ManageController::class, 'update'])->name('manage.update');
Route::delete('/manage/delete/{id}', [ManageController::class, 'delete'])->name('manage.delete');