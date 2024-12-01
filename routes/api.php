<?php

use App\Http\Controllers\Api\AdminComtroller;
use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PakageController;
use App\Http\Controllers\Api\PakageWifiController;
use App\Http\Controllers\Api\PayementGatewayController;
use App\Http\Controllers\Api\TicketWifiController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\WifiZoneController;
use App\Models\PayementGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->prefix('auth/')->group(function(){
    Route::get('test','test');
    Route::post('login','login');
});
Route::get('test1',function(){
    return [
        "juste"=>"un",
        "teste"=>"de merde"
    ];
});
/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/
Route::post('/login',function(){
    return ApiResponse::unauthorized([],'unauthorized');
});
Route::middleware('auth:sanctum')->prefix('admin/')->name('admin.')->group(function(){
    Route::controller(AdminComtroller::class)->group(function(){
        Route::get('current-user','index')->name('index');
        Route::get('payement-gateways/details','payementGateway')->name('payement.gateways');
        Route::put('{payement_gateway}/payement-gateways/update','updatePayementGateway')->name('payement.gateways.update');
    });
    Route::controller(WifiZoneController::class)->prefix('wifi-zone/')->name('wifi.zone.')->group(function(){
        Route::post('create','create')->name('create');
        Route::put('{zone_wifi}/update','update')->name('update');
        Route::delete('{zone_wifi}/delete','delete')->name('delete');
        Route::get('all','all');
    });
    Route::controller(PakageWifiController::class)->prefix('pakage-wifi/')->name('pakage.wifi.')->group(function (){
        Route::post('{zone_wifi}/create','create')->name('create');
        Route::put('{pakage_wifi}/update','update')->name('update');
        Route::get('{pakage_wifi}/details','details')->name('details');
        Route::get('all','index')->name('index');
    });
    Route::controller(TicketWifiController::class)->prefix('ticket-wifi/')->name('ticket.wifi.')->group(function (){
        Route::post('{pakage_wifi}/import','storeTickets')->name('import');
        Route::get('{pakage_wifi}/tickets','index')->name('index');
        Route::delete('{ticket_wifi}/delete','delete')->name('delete');
        Route::get('{ticket_wifi}/details','details')->name('details');
    });
    Route::controller(PakageController::class)->prefix('pakage/')->name('pakage.')->group(function(){
        Route::post('create','create')->name('create');
        Route::put('{pakage}/update','update')->name('update');
        Route::get('{pakage}/details','details')->name('details');
        Route::get('all','index')->name('index');
        Route::delete('{pakage}/delete','delete')->name('delete');
        Route::post('{pakage}/choice-pakage-user','choicePakage')->name('choice.pakage');
    });
    Route::controller(TransactionController::class)->prefix('transactions/')->name('transactions.')->group(function(){
        Route::post('{zone_wifi}/{tiket_wifi}/buyTicket','buyTiket');
    });
    Route::controller(PayementGatewayController::class)->prefix('payement-gateway/')->name('payement.gateway.')->group(function (){
        Route::get('{pakage_wifi}/buyTicket/{amount}','buyTicket');
        Route::get('return/notify','backToPayementNotify')->name('return.notify');
    });
    
});
