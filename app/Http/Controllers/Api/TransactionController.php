<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request){ 
        try{
            $data=Transaction::whereRelation('ticketWifi.pakageWifi.zoneWifis','user_id',Auth::user()->id)->latest()->paginate($request->input('per_page',4));
           // $data=Auth::user()->with(['zoneWifis.pakageWifis.tickets.transaction'])->get();
            return ApiResponse::success($data);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function details(Transaction $transaction){
        try{
            return ApiResponse::success($transaction);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
}
