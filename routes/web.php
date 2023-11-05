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
use App\Http\Controllers\ContactController;

//User
Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin'|| Auth::user()->role === 'moderator') {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('home');
        }
    } else {
        return view('client.login');
    }
})->name('login');

Route::get('/register', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin'|| Auth::user()->role === 'moderator') {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('home');
        }
    } else {
        return view('client.register');
    }
})->name('register');

Route::get('/login', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin'|| Auth::user()->role === 'moderator') {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('home');
        }
    } else {
        return view('client.login');
    }
})->name('login');


Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['checklogin'])->group(function () {
    
    Route::get('/footer',[HomeController::class,'footer'])->name('footer');
    Route::get('/header',[HomeController::class,'header'])->name('header');

    Route::get('/home',[HomeController::class,'home'])->name('home');
    Route::get('/brand',[BrandController::class,'brand'])->name('brand');
    Route::get('/product',[ProductController::class,'product'])->name('product');

    Route::get('/cart',[CartController::class,'cart'])->name('cart');
    Route::post('/cart/create',[CartController::class,'create'])->name('cart.create');
    Route::delete('/cart/delete/{id}',[CartController::class,'delete'])->name('cart.delete');

    Route::get('/contact',[ContactController::class,'show'])->name('contact.show');
    Route::get('/contact/create',[ContactController::class,'create'])->name('contact.create');
    Route::get('/contact/delete/{id}',[ContactController::class,'delete'])->name('contact.delete');
});

//Admin
Route::middleware(['checklogin','checkadmin'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
        
    Route::get('/order1',[OrderController::class, 'view1'])->name('order1');
    Route::get('/order/{id}',[OrderController::class, 'view'])->name('order');
    Route::post('/receipt/save',[ReceiptController::class, 'save'])->name('receipt.save');

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
    Route::delete('/product/{id}',[ProductController::class,'delete'])->name('product.delete');
    Route::post('/product/update/{id}',[ProductController::class,'update'])->name('product.update');

    Route::get('/manage', [ManageController::class,'index'])->name('manage');
    Route::get('/manage/search', [ManageController::class, 'search'])->name('manage.search');
    Route::post('/manage/create', [ManageController::class, 'create'])->name('manage.create');
    Route::post('/manage/update', [ManageController::class, 'update'])->name('manage.update');
    Route::delete('/manage/delete/{id}', [ManageController::class, 'delete'])->name('manage.delete');
});