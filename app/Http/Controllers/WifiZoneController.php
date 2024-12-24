<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponse;
use App\Http\Requests\CreateWifiZoneRequest;
use App\Http\Requests\UpdateWifiZoneRequest;
use App\Models\ZoneWifi;
use App\Enum\StateEnum;
use Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Storage;

class WifiZoneController extends Controller
{
    public function all(Request $request){
        try{
            $query=ZoneWifi::query();
            $perPage=1;
            $page=$request->input('page',1);
            $search =$request->input('search');
            if($search){
                $query->whereRaw("name LIKE '%".$search."%'");
            }
            $total =$query->count();
            $result=$query->offset(($page-1)*$perPage)->limit($perPage)->get();
            //dd($request->all());
            $data=ZoneWifi::latest()->where('state','!=',StateEnum::DELETED)->paginate($request->input('per_page',4));
            return ApiResponse::success($data);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e));
        }
    }
    public function create(CreateWifiZoneRequest $request){
        try{
            //dd($request->file('image'));
            $validated=$request->validated();
            if ($request->hasFile('image')) {
                $validated['image']=$request->file('image')->store('images','public');
            }
            $validated['user_id']=Auth::user()->id;
            
            $wifiZone=ZoneWifi::create($validated);
            return ApiResponse::success($wifiZone);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e));
        }
    }
    public function detail(ZoneWifi $zoneWifi){
        return ApiResponse::success($zoneWifi);
    }
    public function update(UpdateWifiZoneRequest $request,ZoneWifi $zoneWifi){
        try{
            //dd($request->file('image'));
            //dump($zoneWifi->id);
           //dd($request);
            $validated=$request->validated();
            /*if(isset($validated['image']))
            $validated['image']=$request->file('image')->store('images','public');*/
            //dump($validated);
            
        if ($request->hasFile('image')) {
            // delete image
            //dd('images/'.$zoneWifi->image);
            $path=public_path($zoneWifi->image);
            //dd($path);
            Storage::disk('public')->delete($zoneWifi->image);

            $filePath = Storage::disk('public')->put('images', request()->file('image'), 'public');
            $validated['image'] = $filePath;
        }
        //dd($validated);
            $zoneWifi->update($validated);
            return ApiResponse::success($zoneWifi);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
        
    }
    public function delete(ZoneWifi $zoneWifi){
        try{
            //dd($zoneWifi);
            $zoneWifi->state=StateEnum::DELETED;
            $zoneWifi->update();
            return ApiResponse::success($zoneWifi);

        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
}
