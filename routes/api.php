<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/registration-chart-data', [ManageController::class, 'getRegistrationData']);
Route::get('/categories',[CategoryController::class,'getCategoryData']);
Route::get('/user/{id}', [ManageController::class, 'getUser']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});