<?php

namespace App\Http\Controllers\Api;

use App\Enum\StateEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePakageRequest;
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
            $data=Pakage::all();
            return ApiResponse::success($data);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function delete(Pakage $pakage){
        try{
            $pakage->state=StateEnum::DESACTIVE;
            $pakage->update();
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
                $pakageUser=new PakageUser([
                    'user_id'=>Auth::user()->id
                ]);
                //Auth::user()->pakageUser()->save($pakageUser);
                $pakage->pakagesUser()->save($pakageUser);
    
                return ApiResponse::success($pakageUser);
            }
            
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
}
