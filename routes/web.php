<?php

use App\Events\testSocketEvent;
use App\Http\Controllers\Api\PayementGatewayController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/post', function () {
    event(new testSocketEvent(['un monde de fou']));
    return 'ok';
});

Route::controller(SiteController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::prefix('/site')->name('site.')->group(function (){
        Route::post('submit/email','submitEmail')->name('submit.email');
        Route::get('create/account','showCreateAccount')->name('create.account');
        Route::get('buy-ticket/sucess/{transaction}','showSucessTicket')->name('buy.ticket.success');
        Route::get('buy-ticket/download/{transaction}','downloadTicket')->name('buy.ticket.doaload');
        Route::get('buy-ticket/failed/{transaction}','showFailedTicket')->name('buy.ticket.failed');
        Route::get("language-{lang}","changeLanguage")->name('language');
        Route::get("signup/user","showSignup")->name("signup.user");
        Route::post("create-account","createAccount")->name("create.account");
    });
    Route::prefix('payement/')->name('payement.')->group(function (){
        Route::get('return/ticket','backToPayement')->name('return.ticket');
    });
    
});
Route::controller(PayementGatewayController::class)->prefix('payement-gateway/')->name('payement.gateway.')->group(function (){
    //Route::get('{pakage_wifi}/buyTicket/{amount}','buyTicket');
    Route::post('return/ticket/cinetpay','backToPayementReturnCinetpay')->name('return.ticket.cinetpay');
    Route::post('return/notify/cinetpay','backToPayementNotifyCinetpay')->name('return.notify.cinetpay');
    Route::get('return/notify','backToPayementFailedCampay')->name('return.notify');
    Route::get('return/ticket/campay','backToPayementCampay')->name('return.ticket.campay');
    Route::get('return/failed/campay','backToPayementFailedCampay')->name('return.failed.campay');
    Route::post('return/mikrotik','goToMikrotik')->name('return.mikrotik');
    
});