<?php

use App\Http\Controllers\Api\AdminComtroller;
use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\MoneyWithdrawalsController;
use App\Http\Controllers\Api\PakageController;
use App\Http\Controllers\Api\PakageWifiController;
use App\Http\Controllers\Api\PayementGatewayController;
use App\Http\Controllers\Api\TicketWifiController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserCareController;
use App\Http\Controllers\WifiZoneController;
use App\Models\PayementGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login',function(){
    //return ApiResponse::unauthorized([],'unauthorized');
});
Route::controller(AuthController::class)->prefix('auth/')->group(function(){
    Route::get('test','test');
    Route::post('login','login');
});
Route::middleware(['auth:sanctum'])->get('test1',function(){
    return [
        "juste"=>"un",
        "teste"=>"de merde"
    ];
});
/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::controller(PayementGatewayController::class)->prefix('payement-gateway/')->name('payement.gateway.')->group(function (){
    Route::post('{pakage_wifi}/init-buy-ticket','initBuyTicket')->name('init.buy.ticket');
});
Route::middleware(['auth:sanctum'])->prefix('admin/')->name('admin.')->group(function(){
    Route::controller(AdminComtroller::class)->group(function(){
        Route::get('current-user','index')->name('index');
        Route::post('payement-gateways/create','create')->name('create');
        Route::get('payement-gateways/{payement_gateway}/details','details')->name('payement.gateways.details');
        Route::put('payement-gateways/{payement_gateway}/update','updatePayementGateway')->name('payement.gateways.update');
        Route::get('payement-gateways/alls','gateway')->name('all');
    });
    Route::controller(WifiZoneController::class)->prefix('wifi-zone/')->name('wifi.zone.')->group(function(){
        Route::post('create','create')->name('create');
        Route::put('{zone_wifi}/update','update')->name('update');
        Route::delete('{zone_wifi}/delete','delete')->name('delete');
        Route::get('all','all');
        Route::get('full-all','full')->name('full');
        Route::get('full-all/user','fullUser')->name('full.user');
        Route::get('{zone_wifi}/detail','detail')->name('detail');
    });
    Route::controller(PakageWifiController::class)->prefix('pakage-wifi/')->name('pakage.wifi.')->group(function (){
        Route::post('{zone_wifi}/create','create')->name('create');
        Route::put('{pakage_wifi}/update','update')->name('update');
        Route::delete('{pakage_wifi}/delete','delete')->name('delete');
        Route::get('{zone_wifi}/pakage-wifis','pakageWifiFromWifiZone')->name('pakage-wifi');
        Route::get('{pakage_wifi}/details','details')->name('details');
        Route::get('all','index')->name('index');
        Route::get('full-all','full')->name('full');
    });
    Route::controller(TicketWifiController::class)->prefix('ticket-wifi/')->name('ticket.wifi.')->group(function (){
        Route::post('{pakage_wifi}/import','storeTickets')->name('import');
        Route::get('{pakage_wifi}/ticket-wifis','ticketWifis')->name('tiket-wifi');
        Route::get('all','index')->name('index');
        Route::get('full-all','full')->name('full');
        Route::delete('{ticket_wifi}/delete','delete')->name('delete');
        Route::get('{ticket_wifi}/details','details')->name('details');
    });
    Route::controller(PakageController::class)->prefix('pakage/')->name('pakage.')->group(function(){
        Route::post('create','create')->name('create');
        Route::put('{pakage}/update','update')->name('update');
        Route::post('is-sms','setIsSendSms')->name('set.sms');
        Route::get('{pakage}/details','details')->name('details');
        Route::get('all','index')->name('index');
        Route::get('full-all','full')->name('full');
        Route::get('current','currentPakageUser')->name('current');
        Route::delete('{pakage}/delete','delete')->name('delete');
        Route::post('{pakage}/choice-pakage-user','choicePakage')->name('choice.pakage');
    });
    Route::controller(TransactionController::class)->prefix('transactions/')->name('transactions.')->group(function(){
        Route::post('alls','index')->name('all');
        Route::post('{ticket_wifi}/tickets','tickets')->name('tickets');
        Route::post('{pakage_wifi}/pakage-wifi','pakageWifi')->name('pakage.wifi');
        Route::post('{zone_wifi}/zone-wifi','zoneWifi')->name('zone.wifi');
        Route::get('{transaction}/details','details')->name('details');
    });
    Route::controller(MoneyWithdrawalsController::class)->prefix('money-withdrawals/')->name('money-withdrawals.')->group(function(){
        Route::post('create','create')->name('create');
        Route::put('update','update')->name('update');
        Route::get('{money_withdrawal}/details','details')->name('details');

        Route::get('amounts','moneyCollect')->name('amounts');
        Route::get('all','index')->name('index');
        Route::middleware('admin')->group(function (){
            Route::get('all-user','all')->name('all.user');
            Route::put('{money_withdrawal}/valid-withdrawal','validWithdrawal')->name('valid');
            Route::put('{money_withdrawal}/reject-withdrawal','rejectWithdrawal')->name('reject');
        });
    });
    Route::controller(DashboardController::class)->prefix('dashboard/')->name('dashboard.')->group(function (){
        Route::post('all','index')->name('index');
        Route::get('full-all','full')->name('all');
    });
    Route::middleware('admin')->controller(UserCareController::class)->prefix('user-care/')->name('user.care')->group(function(){
        Route::get('all','index')->name('index');
        Route::get('full-all','full')->name('all');
        Route::put('{user}/activate','activate')->name('activate');
        Route::put('{user}/desactivate','desactivate')->name('desactivate');
        Route::get('{user}/details','details')->name('details');
        Route::delete('{user}/delete','delete')->name('index');
    });
    //middleware
    
});


