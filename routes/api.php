<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ManageController;
use Illuminate\Support\Facades\Route;

Route::get('/registration-chart-data', [ManageController::class, 'getRegistrationData']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});