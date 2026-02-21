<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\CouponController;

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/offers',[OfferController::class,'index']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/purchases',[PurchaseController::class,'store']);
    Route::get('/my-coupons',[CouponController::class,'index']);
});
Route::middleware('auth:sanctum')->post('/change-password', [AuthController::class, 'changePassword']);