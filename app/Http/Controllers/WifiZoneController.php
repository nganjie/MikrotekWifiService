<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponse;
use App\Http\Requests\CreateWifiZoneRequest;
use App\Models\ZoneWifi;
use Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class WifiZoneController extends Controller
{
    public function create(CreateWifiZoneRequest $request){
        try{
            //dd($request->file('image'));
            $validated=$request->validated();
            $validated['image']=$request->file('image')->store('images','public');
            //dump(Auth::user()->id);
            $validated['user_id']=Auth::user()->id;
            $wifiZone=ZoneWifi::create($validated);
            return ApiResponse::success($wifiZone);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e));
        }
    }
    public function update(ZoneWifi $zoneWifi,CreateWifiZoneRequest $request){
        try{
            //dd($request->file('image'));
            dd($zoneWifi);
            $validated=$request->validated();
            if(isset($validated['image']))
            $validated['image']=$request->file('image')->store('images','public');
            //dump($validated);
            $wifiZone=ZoneWifi::create($validated);
            return ApiResponse::success($wifiZone);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e));
        }
    }
}
