<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePakageWifiRequest;
use App\Http\Requests\UpdatePakageWifiRequest;
use App\Models\PakageWifi;
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
            $data=PakageWifi::latest()->with('zoneWifis')->whereRelation('zoneWifis','user_id',$user->id)->paginate($request->input('per_page',4));
           // $z=ZoneWifi::first()->with('pakage_wifi');
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
    public function details(PakageWifi $pakageWifi){
        try{
            //$pakage=
            return ApiResponse::success(PakageWifi::with('zoneWifis')->find($pakageWifi->id));
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    
}
