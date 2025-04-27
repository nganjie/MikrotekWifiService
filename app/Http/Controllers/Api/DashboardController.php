<?php

namespace App\Http\Controllers\Api;

use App\Enum\GroupByEnum;
use App\Enum\StateEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\DashboardRequest;
use App\Models\PakageWifi;
use App\Models\Transaction;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function details(User $user){
        try{
            //$user->update($validated);
            return ApiResponse::success($user);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function index(DashboardRequest $request){
        try{
            $validated=$request->validated();
            $user_id=$validated['user_id'];
            $user=User::find($user_id);
            //$dat=PakageWifi::with('zoneWifis')->select(DB::raw('zone_wifi_id as id_t,SUM(price) as pric'),'zone_wifis.id as idrt')->groupBy('id_t')->get();
            //return $dat;
          /*  $stats = DB::table('transactions')
    ->join('ticket_wifis', 'transactions.ticket_wifi_id', '=', 'ticket_wifis.id')
    ->join('pakage_wifis', 'ticket_wifis.pakage_wifi_id', '=', 'pakage_wifis.id')
    ->join('zone_wifis', 'pakage_wifis.zone_wifi_id', '=', 'zone_wifis.id')
    ->select(
        'zone_wifis.id as zone_id',
        'zone_wifis.name as zone_name',
        //'pakage_wifis.id as package_id',
        //'pakage_wifis.designation as pakage_name',
        DB::raw("SUM(CASE WHEN transactions.status = 'success' THEN 1 ELSE 0 END) as success_count"),
        DB::raw("SUM(CASE WHEN transactions.status = 'failed' THEN 1 ELSE 0 END) as failed_count"),
        DB::raw("SUM(CASE WHEN transactions.status = 'pending' THEN 1 ELSE 0 END) as pending_count"),
        DB::raw("SUM(CASE WHEN status = 'collected' THEN 1 ELSE 0 END) as collected")
    )
    ->groupBy('zone_wifis.id')
    ->get();*/

    //return $stats;
   // $totalAmount=Transaction::current($user)->where('status','pending')->whereDoesntHave('moneyWithdrawal')->sum('price');
    $totalQuery =Transaction::current($user)->select(
        'status',
        DB::raw('SUM(price) as total_amount')
    )
    ->groupBy('status');

            $query =Transaction::current($user);
            //->groupBy('zone_wifis.id')// si relation définie dans Transaction
            //->filterByPeriod('ThisMonth')->get();
            if(isset($validated['group_by'])){
                $group_by=$validated['group_by'];
                if($group_by==GroupByEnum::ZoneWifi->label()){
                    $query->select(
                        DB::raw("SUM(CASE WHEN status = 'success' THEN 1 ELSE 0 END) as success"),
                        DB::raw("SUM(CASE WHEN status = 'failed' THEN 1 ELSE 0 END) as failed"),
                        DB::raw("SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending"),
                        DB::raw("SUM(CASE WHEN status = 'collected' THEN 1 ELSE 0 END) as collected"),
                        'zone_wifis.name as name',
                    )->groupBy('zone_wifis.id');
                    $query->groupBy('zone_wifis.id');
                }else if($group_by==GroupByEnum::PakageWifi->label()){
                    $query->select(
                        DB::raw("SUM(CASE WHEN status = 'success' THEN 1 ELSE 0 END) as success"),
                        DB::raw("SUM(CASE WHEN status = 'failed' THEN 1 ELSE 0 END) as failed"),
                        DB::raw("SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending"),
                        DB::raw("SUM(CASE WHEN status = 'collected' THEN 1 ELSE 0 END) as collected"),
                        DB::raw("CONCAT(zone_wifis.name, ' - ', pakage_wifis.designation) as name"),
                    )->groupBy('pakage_wifis.id');
                }
            }else{
                $query->select(
                    DB::raw("SUM(CASE WHEN status = 'success' THEN 1 ELSE 0 END) as success"),
                    DB::raw("SUM(CASE WHEN status = 'failed' THEN 1 ELSE 0 END) as failed"),
                    DB::raw("SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending"),
                    DB::raw("SUM(CASE WHEN status = 'collected' THEN 1 ELSE 0 END) as collected"),
                    DB::raw("CONCAT(zone_wifis.name, ' - ', pakage_wifis.designation) as name"),
                )->groupBy('pakage_wifis.id');
            }
            $query->join('ticket_wifis', 'transactions.ticket_wifi_id', '=', 'ticket_wifis.id')
            ->join('pakage_wifis', 'ticket_wifis.pakage_wifi_id', '=', 'pakage_wifis.id')
            ->join('zone_wifis', 'pakage_wifis.zone_wifi_id', '=', 'zone_wifis.id');
            if(isset($validated['zone_wifi'])&&(!isset($validated['pakage_wifi']))){
                $zone_wifi_id=$validated['zone_wifi'];
                $query->zoneWifi($zone_wifi_id);
                $totalQuery->zoneWifi($zone_wifi_id);
            }else if(isset($validated['pakage_wifi'])){
                $pakage_wifi=$validated['pakage_wifi'];
                $query->pakageWifi($pakage_wifi);
                $totalQuery->pakageWifi($pakage_wifi);
            }
            if(isset($validated['period'])){
                $period=$validated['period'];
                $start_date=$validated['start_date']??null;
                $end_date=$validated['end_date']??null;
                $query->filterByPeriod($period,$start_date,$end_date);
                $totalQuery->filterByPeriod($period,$start_date,$end_date);
            }
            $totalAmounts=$totalQuery->get();
            $stats=$query->get();
           /* $amounts=Transaction::current()->where('status',StateEnum::SUCCESS)->doesntHave('moneyWithdrawal')->get()->sum(function ($query) {
                return $query->price + $query->sms_charge;
            });*/
            //$user->update($validated);
            $data=[
                'totalAmount'=>$totalAmounts,
                'stats'=>$stats
            ];
            //$data=User::latest()->paginate($request->input('per_page',4));
            return ApiResponse::success($data);
        }catch(\Exception $e){
            dd($e);
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function full(){
        try{
            //$user->update($validated);
            $data=User::latest()->get();
            return ApiResponse::success($data);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function activate(User $user){
        try{
            $user->is_activate=true;
            $user->state=StateEnum::ACTIVE->label();
            $user->update();
            return ApiResponse::success($user);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function desactivate(User $user){
        try{
            $user->is_activate=false;
            $user->state=StateEnum::DESACTIVE->label();
            $user->update();
            return ApiResponse::success($user);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function delete(User $user){
        try{
            $user->state=StateEnum::DESACTIVE;
            $user->update();
            return ApiResponse::success($user);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
}
