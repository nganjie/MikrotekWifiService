<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::controller(SiteController::class)->prefix('/site')->name('site.')->group(function(){
    Route::get('/','index')->name('index');
    Route::post('submit/email','submitEmail')->name('submit.email');
});