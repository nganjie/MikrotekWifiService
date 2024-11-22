<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\authRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function test(){
        return ApiResponse::success('ok');
    }
    public function login(authRequest $request){
       
        try{
            //dd($request);
            $user=User::where('email',$request->email)->first();

            if(Auth::attempt($request->only(['email','password']))){
                $token = $user->createToken('tokenMikrotekWifi')->plainTextToken;
                return ApiResponse::success($user,$token);
            }else{
                return ApiResponse::error(__('incorrect identifiers'));
            }
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrog',$e));
        }
    }
}
