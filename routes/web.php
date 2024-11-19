<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('index');
});*/

Route::controller(SiteController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::prefix('/site')->name('site.')->group(function (){
        Route::post('submit/email','submitEmail')->name('submit.email');
        Route::get('create/account','showCreateAccount')->name('create.account');
        Route::get("language-{lang}","changeLanguage")->name('language');
        Route::get("signup/user","showSignup")->name("signup.user");
        Route::post("create-account","createAccount")->name("create.account");
    });
    
});