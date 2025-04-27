<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePayementGatewayRequest;
use App\Http\Requests\UpdatePayementGatewayRequest;
use App\Models\PayementGateway;
use App\Models\User;
use Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class AdminComtroller extends Controller
{

    public function create(CreatePayementGatewayRequest $request){
        try{
            //dd($request->file('image'));
            $validated=$request->validated();
            //$validated['user_id']=Auth::user()->id;
            
            $payementGateway=PayementGateway::create($validated);
            return ApiResponse::success($payementGateway);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e));
        }
    }
    public function gateway(Request $request){
        try{
            $user=User::where('id',Auth::user()->id)->first();
            //$data=$user->zoneWifis()->with('pakageWifis')->get();
            $data=PayementGateway::paginate($request->input('per_page',4));
           // $z=ZoneWifi::first()->with('pakage_wifi');
            return ApiResponse::success($data);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function index(){
        return ApiResponse::success(Auth::user());
    }
    public function details(PayementGateway $payementGateway){
        try{
            //$pakage->update($validated);
            return ApiResponse::success($payementGateway);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function payementGateway(){
        //$payementGateway=PayementGateway::first();
        $payementGateway=PayementGateway::create([
            'site_id'=>'5866070',
            'secret_key'=>'18582845296560d3657cd0d5.85052866',
            'api_key'=>'107067243165f9bc125bd708.12034396',
            'url'=>'https://api-checkout.cinetpay.com/v2/payment',
        ]);
        return ApiResponse::success($payementGateway);
    }
    public function updatePayementGateway(UpdatePayementGatewayRequest $request,PayementGateway $payementGateway){
        try{
            $validated=$request->validated();
            $payementGateway->update($validated);
            return ApiResponse::success($payementGateway);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
        $payementGateway=PayementGateway::first();
        return ApiResponse::success($payementGateway);
    }
    public function backToPayementNotify(Request $request){
        dd($request);
    }
}
