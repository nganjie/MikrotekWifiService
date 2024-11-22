<?php

use App\Http\Controllers\Api\AdminComtroller;
use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->prefix('auth/')->group(function(){
    Route::get('test','test');
    Route::post('login','login');
});
/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/
Route::post('/login',function(){
    return ApiResponse::unauthorized([],'unauthorized');
});
Route::middleware('auth:sanctum')->prefix('admin/')->group(function(){
    Route::controller(AdminComtroller::class)->group(function(){
        Route::get('current-user','index');
    });
});
