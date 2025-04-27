<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePakageWifiRequest;
use App\Http\Requests\UpdatePakageWifiRequest;
use App\Models\PakageWifi;
use App\Models\TicketWifi;
use App\Models\User;
use App\Models\ZoneWifi;
use Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class PakageWifiController extends Controller
{
    public function index(Request $request){
        try{
            $user=User::where('id',Auth::user()->id)->first();
            //$data=$user->zoneWifis()->with('pakageWifis')->get();
            $data=PakageWifi::current($request->input('user_id',null))->zoneWifi($request->input('zone_wifi_id',null))->latest()->with('zoneWifis')->whereRelation('zoneWifis','user_id',$user->id)->paginate($request->input('per_page',4));
            return ApiResponse::success($data);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function full(Request $request){
        try{
            $user=User::where('id',Auth::user()->id)->first();
            $data=PakageWifi::current($request->input('user_id',null))->latest()->with('zoneWifis')->whereRelation('zoneWifis','user_id',$user->id)->get();
            return ApiResponse::success($data);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function pakageWifiFromWifiZone(Request $request,ZoneWifi $zoneWifi){
        try{
            //$user=User::where('id',Auth::user()->id)->first();
            //$data=$user->zoneWifis()->with('pakageWifis')->get();
            //return $zoneWifi->pakageWifis()->paginate($request->input('per_page',4));
            $data=$zoneWifi->pakageWifis()->with('zoneWifis')->paginate($request->input('per_page',4));
            //dd($data);
            /*$finalData=[];
            foreach($data as $d){
                if(TicketWifi::where('pakage_wifi_id',$d->id)->where('state','active')->first()){
                    $finalData[]=$d;
                }
            }*/
            //dd($finalData);
            return ApiResponse::success($data);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function create(CreatePakageWifiRequest $request, ZoneWifi $zoneWifi){
        try{
            $validated=$request->validated();
            //dd($request);
            $pakageWifi=new PakageWifi($validated);
            $zoneWifi->pakageWifis()->save($pakageWifi);
            return ApiResponse::success($pakageWifi);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function update(UpdatePakageWifiRequest $request,PakageWifi $pakageWifi){
        try{
            $validated=$request->validated();
            $pakageWifi->update($validated);
           // $pakageWifi->refresh();
            //dd($validated);
            return ApiResponse::success($pakageWifi);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function initBuyTicket(){
        
    }
    public function delete(PakageWifi $pakageWifi){
        try{
            $pakageWifi->delete();
            return ApiResponse::success([]);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function details(PakageWifi $pakageWifi){
        try{
            //$pakage=
            return ApiResponse::success(PakageWifi::with('zoneWifis')->find($pakageWifi->id));
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    
}
