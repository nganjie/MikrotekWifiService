<?php

namespace App\Http\Controllers\Api;

use App\Enum\StateEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class UserCareController extends Controller
{

    public function details(User $user){
        try{
            //$user->update($validated);
            return ApiResponse::success($user);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function index(Request $request){
        try{
            //$user->update($validated);
            $data=User::latest()->paginate($request->input('per_page',4));
            return ApiResponse::success($data);
        }catch(\Exception $e){
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
