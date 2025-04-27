<?php

namespace App\Http\Controllers\Api;

use App\Enum\StateEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePakageRequest;
use App\Http\Requests\pakageUserUpdateRequest;
use App\Http\Requests\UpdatePakageRequest;
use App\Models\Pakage;
use App\Models\PakageUser;
use Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class PakageController extends Controller
{
    public function create(CreatePakageRequest $request){
        try{
            $validated=$request->validated();
            $pakage=new Pakage($validated);
            Auth::user()->pakages()->save($pakage);
            return ApiResponse::success($pakage);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function update(UpdatePakageRequest $request,Pakage $pakage){
        try{
            $validated=$request->validated();
            $pakage->update($validated);
            return ApiResponse::success($pakage);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function details(Pakage $pakage){
        try{
            //$pakage->update($validated);
            return ApiResponse::success($pakage);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function index(){
        try{
            //$pakage->update($validated);
            $data=Pakage::latest()->get();
            return ApiResponse::success($data);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function full(){
        try{
            //$pakage->update($validated);
            $data=Pakage::latest()->get();
            return ApiResponse::success($data);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function delete(Pakage $pakage){
        try{
            //$pakage->state=StateEnum::DESACTIVE;
            $pakage->delete();
            return ApiResponse::success($pakage);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function choicePakage(Pakage $pakage){
        try{
            $tmpPakageUser=$pakage->pakagesUser()->where('user_id',Auth::user()->id)->first();
            if($tmpPakageUser){
                return ApiResponse::error(__('pakage already exists'));
            }else{
                $pakageUser=PakageUser::with('pakage')->where('user_id',Auth::user()->id)->first();
                if($pakageUser){
                    $pakageUser->pakage_id=$pakage->id;
                    $pakageUser->save();
                    return ApiResponse::success($pakageUser);
                }else{
                    $pakageUser=new PakageUser([
                        'user_id'=>Auth::user()->id
                    ]);
                    //Auth::user()->pakageUser()->save($pakageUser);
                    $pakage->pakagesUser()->save($pakageUser);
        
                    return ApiResponse::success($pakageUser);
                }
                
            }
            
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function setIsSendSms(pakageUserUpdateRequest $request){
        try{
            $validated=$request->validated();
            $pakageUser=PakageUser::where('user_id',Auth::user()->id)->first();
            $pakageUser->is_send_message=$validated['is_send_message'];
            $pakageUser->update();
            return ApiResponse::updated($pakageUser);
            
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function currentPakageUser(){
        try{
            //$pakage->update($validated);
            $data=PakageUser::with('pakage')->where('user_id',Auth::user()->id)->first();
            return ApiResponse::success($data);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
}
