<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionFilterRequest;
use App\Models\PakageWifi;
use App\Models\TicketWifi;
use App\Models\Transaction;
use App\Models\ZoneWifi;
use Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(TransactionFilterRequest $request){ 
        try{
            $validated=$request->validated();
            if(isset($validated['zone_wifi'])&&(!isset($validated['pakage_wifi']))){
                $zone_wifi_id=$validated['zone_wifi'];
                $query=Transaction::latest()->with(['ticketWifi','moneyWithdrawal','ticketWifi.pakageWifi','ticketWifi.pakageWifi.zoneWifis'])->current(Auth::user())->zoneWifi($zone_wifi_id);
            }else if(isset($validated['pakage_wifi'])){
                $pakage_wifi=$validated['pakage_wifi'];
                $query=Transaction::latest()->with(['ticketWifi','moneyWithdrawal','ticketWifi.pakageWifi','ticketWifi.pakageWifi.zoneWifis'])->current(Auth::user())->pakageWifi($pakage_wifi);
            }else{
                $query=Transaction::latest()->with(['ticketWifi','moneyWithdrawal','ticketWifi.pakageWifi','ticketWifi.pakageWifi.zoneWifis'])->current(Auth::user());
            }
            if(isset($validated['status'])){
                $status=$validated['status'];
                $query->where('status',$status);
            }
            if(isset($validated['period'])){
                $period=$validated['period'];
                $start_date=$validated['start_date']??null;
                $end_date=$validated['end_date']??null;
                $query->filterByPeriod($period,$start_date,$end_date);
            }
            //dd(1);
            $data=$query->latest()->paginate($request->input('per_page',4));
            //$data=Transaction::latest()->with(['ticketWifi','moneyWithdrawal','ticketWifi.pakageWifi','ticketWifi.pakageWifi.zoneWifis'])->current(Auth::user())->paginate($request->input('per_page',4));
            //whereRelation('ticketWifi.pakageWifi.zoneWifis','user_id',Auth::user()->id)->latest()->paginate($request->input('per_page',4));
           // $data=Auth::user()->with(['zoneWifis.pakageWifis.tickets.transaction'])->get();
            return ApiResponse::success($data);
        }catch(\Exception $e){
            dd($e);
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function all(Request $request){ 
        try{
            $data=Transaction::latest()->with(['ticketWifi','moneyWithdrawal','ticketWifi.pakageWifi','ticketWifi.pakageWifi.zoneWifis'])->current(Auth::user())->paginate($request->input('per_page',4));
            //whereRelation('ticketWifi.pakageWifi.zoneWifis','user_id',Auth::user()->id)->latest()->paginate($request->input('per_page',4));
           // $data=Auth::user()->with(['zoneWifis.pakageWifis.tickets.transaction'])->get();
            return ApiResponse::success($data);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function tickets(Request $request,TicketWifi $ticketWifi){
        try{
            $data= $ticketWifi->transaction()->with(['ticketWifi','moneyWithdrawal','ticketWifi.pakageWifi','ticketWifi.pakageWifi.zoneWifis'])->paginate($request->input('per_page',4));
            return ApiResponse::success($data);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function pakageWifi(TransactionFilterRequest $request,PakageWifi $pakageWifi){
        try{
            $validated=$request->validated();
            
            $query=Transaction::latest()->with(['ticketWifi','moneyWithdrawal','ticketWifi.pakageWifi','ticketWifi.pakageWifi.zoneWifis'])->current(Auth::user());

            if(isset($validated['status'])){
                $status=$validated['status'];
                $query->where('status',$status);
            }
            if(isset($validated['period'])){
                $period=$validated['period'];
                $start_date=$validated['start_date']??null;
                $end_date=$validated['end_date']??null;
                $query->filterByPeriod($period,$start_date,$end_date);
            }
            $data=$query->whereRelation('ticketWifi.pakageWifi','id',$pakageWifi->id)->paginate($request->input('per_page',4));
            //$data= $pakageWifi->tickets()->transaction()->with(['moneyWithdrawal','pakageWifi','pakageWifi.zoneWifis'])->paginate($request->input('per_page',4));
            return ApiResponse::success($data);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function zoneWifi(TransactionFilterRequest $request,ZoneWifi $zoneWifi){
        try{
            $validated=$request->validated();
            if(isset($validated['pakage_wifi'])){
                $pakage_wifi=$validated['pakage_wifi'];
                $query=Transaction::latest()->with(['ticketWifi','moneyWithdrawal','ticketWifi.pakageWifi','ticketWifi.pakageWifi.zoneWifis'])->current(Auth::user())->pakageWifi($pakage_wifi);
            }else{
                $query=Transaction::latest()->with(['ticketWifi','moneyWithdrawal','ticketWifi.pakageWifi','ticketWifi.pakageWifi.zoneWifis'])->current(Auth::user());
            }
            if(isset($validated['status'])){
                $status=$validated['status'];
                $query->where('status',$status);
            }
            if(isset($validated['period'])){
                $period=$validated['period'];
                $start_date=$validated['start_date']??null;
                $end_date=$validated['end_date']??null;
                $query->filterByPeriod($period,$start_date,$end_date);
            }
            $data= $query->whereRelation('ticketWifi.pakageWifi.zoneWifis','id',$zoneWifi->id)->paginate($request->input('per_page',4));
            return ApiResponse::success($data);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function details(Transaction $transaction){
        try{
            return ApiResponse::success($transaction->with(['ticketWifi','moneyWithdrawal','ticketWifi.pakageWifi','ticketWifi.pakageWifi.zoneWifis'])->find($transaction->id));
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
}
