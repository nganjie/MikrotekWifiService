<?php

namespace App\Http\Controllers\Api;

use App\Enum\PayementGatewayTypeEnum;
use App\Enum\StateEnum;
use App\Http\Controllers\Controller;
use App\Models\PakageUser;
use App\Models\PakageWifi;
use App\Models\PayementGateway;
use App\Models\TicketWifi;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\MessageTicketMail;
use App\Notifications\SendParentEmailNotification;
use Auth;
use DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Str;

class PayementGatewayController extends Controller
{
    
    public function initBuyTicket(Request $request,PakageWifi $pakageWifi){
        try{
            //return auth()->user;
            //dd($request->input('numero',null));
            //return route('payement.gateway.return.failed.campay');
            DB::beginTransaction();
            $receiver_number=$request->input('numero',null);
            //dd($receiver_number);
           $zoneWifi= $pakageWifi->zoneWifis()->first();
           //return $pakageWifi->tickets()->where('state',StateEnum::ACTIVE)->whereDoesntHave('transaction')->count();
           //return $pakageWifi->tickets()->count();
           
          // return 1;
            $payementGateway=PayementGateway::where('is_active',true)->first();
            $pakageUser=PakageUser::where('user_id',$zoneWifi->user_id)->with('pakage')->first();
            //$data=$ticket->with(['pakageWifi','pakageWifi.zoneWifis'])->first();
            //$zoneWifi= $data->pakageWifi->zoneWifis;
            //$pakageUser=PakageUser::where('user_id',$zoneWifi->user_id)->first();
            //dd($pakageUser->pakage);
            //return $pakageWifi->price;
            if($pakageUser){
                $transaction=new Transaction([
                    'type'=>'ticket',
                    'status'=>StateEnum::PENDING,
                    'price'=>$pakageWifi->price,
                    'net_price'=>$pakageWifi->price,
                    'receiver_number'=>$receiver_number
                ]);
           $ticket =$pakageWifi->tickets()->where('state',StateEnum::ACTIVE)->first();
           //return $ticket;
           //dd($ticket);
           //return $ticket->id;
           if($ticket){
            $pakageWifi->load('zoneWifis');
            $payementGateway=PayementGateway::where('is_active',true)->first();
            $dataResponse=[];
            $ticket->state=StateEnum::PENDING;
           // dd($payementGateway);

            $ticket->transaction()->save($transaction);
            $ticket->update();
            if($payementGateway->name==PayementGatewayTypeEnum::CINETPAY->label()){
                $response=ApiGateway::cinetPayApi($pakageWifi,$zoneWifi,$payementGateway,$ticket,$transaction);
                //dd($response);
                if($response['code']=='201'){
                    
                    $dataResponse=[
                        "payement_link"=>$response['data']['payment_url']
                    ];
                  }
            }else{
                $response=ApiGateway::camPayApi($pakageWifi,$zoneWifi,$payementGateway,$transaction);
                $dataResponse=$response;
                $dataResponse=[
                    "payement_link"=>$response['link']
                ];
            }
            if($dataResponse["payement_link"]){
                DB::commit();

                //return $dataResponse;
                return ApiResponse::success($dataResponse);
            }else{
                $ticket->state=StateEnum::ACTIVE;
                    $ticket->update();
                    $ticket->transaction($transaction)->delete();
                    return ApiResponse::error();
            }
            //return $dataResponse;
           }else{
            $user=User::find($zoneWifi->user_id);
           $user->notify((new MessageTicketMail([
            'title'=>'Nombre De Ticket Insufisant',
            'message'=>'Les Tickets dans le pakage wifi '.$pakageWifi->designation.' est '.$pakageWifi->tickets()->where('state',StateEnum::ACTIVE)->whereDoesntHave('transaction')->count().' dans la zone wifi '.$zoneWifi->name
           ]))->delay(now()->addMinutes(1)));
            return ApiResponse::error(__("Aucun ticket disponible pour se pakage Wifi"),[
                'error'=>125,
            ]);
           }
            
            }else{
                $user=User::find($zoneWifi->user_id);
           $user->notify((new MessageTicketMail([
            'title'=>"Erreur Survenue Lors de l'achat d'un ticket",
            'message'=>"Erreur Survenue Lors de l'achat d'un ticket dans le pakage wifi ".$pakageWifi->designation.' est '.$pakageWifi->tickets()->count().' dans la zone wifi '.$zoneWifi->name
           ]))->delay(now()->addMinutes(1)));
                return ApiResponse::error(__("une erreur est survenue veillez contacter votre admib=nistrateur",[
                    'error'=>127
                ]));
            }
          
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
        
    }
    public function backToPayementReturnCinetpay(Request $request){
        //dd($request);
        $transaction_id=$request->transaction_id;
        $transaction=Transaction::find($transaction_id);
        $response=ApiGateway::cinetPayApiCheck($transaction);
        try{
            session()->put('data', $response);;
            $ticket =$transaction->ticketWifi()->first();
            if($response['message']=='SUCCES'){
                $ticket->update([
                    'state'=>StateEnum::USE
                ]);
                $transaction->update([
                    'status'=>StateEnum::SUCCESS
                ]);
                $data=$ticket->with(['pakageWifi','pakageWifi.zoneWifis'])->first();
                $zoneWifi= $data->pakageWifi->zoneWifis;
                $pakageUser=PakageUser::where('user_id',$data->pakageWifi->zoneWifis->user_id)->with('pakage')->first();

                if($pakageUser->is_send_message){
                   $rest= ApiGateway::sendMessagge($zoneWifi,$ticket,$transaction);
                   $transaction->update([
                    'sms_charge'=>$pakageUser->pakage->sms_charge,
                    'operation_reference'=>$rest['id'],
                    'is_send_sms'=>1
                   ]);
                }
                return redirect()->intended(route('site.buy.ticket.success',$transaction));
            }else if($response['message']=='PAYMENT_FAILED'){
                $ticket->update([
                    'state'=>StateEnum::ACTIVE
                ]);
                $transaction->update([
                    'status'=>StateEnum::FAILED
                ]);
                return redirect()->intended(route('site.buy.ticket.success',$transaction));
               // return redirect($data->pakageWifi->zoneWifis->captive_gate);
               // return redirect()->intended(route('site.buy.ticket.failed',$transaction));
            }else{
                dd($response);
            }
        }catch(\Exception $e){
            dump($response);
            dd($e);
        }
        
    }
    public function backToPayementNotifyCinetpay(Request $request){
        dd($request);
        http_response_code(200);
        dd($request);
    }

    public function backToPayementCampay(Request $request){
        $transaction_id=$request->external_reference;
        $transaction=Transaction::find($transaction_id);
        $ticket =$transaction->ticketWifi()->first();
        try{
            session()->put('data', [
                'reference'=>$request->input('external_reference')
            ]);
            $ticket =$transaction->ticketWifi()->first();
            $ticket->update([
                'state'=>StateEnum::USE
            ]);
            $transaction->update([
                'status'=>StateEnum::SUCCESS
            ]);
            $data=$ticket->with(['pakageWifi','pakageWifi.zoneWifis'])->first();
            $zoneWifi= $data->pakageWifi->zoneWifis;
            $pakageUser=PakageUser::where('user_id',$data->pakageWifi->zoneWifis->user_id)->with('pakage')->first();
            if($pakageUser->is_send_message){
                $rest= ApiGateway::sendMessagge($zoneWifi,$ticket,$transaction);
                //dd($rest);
                $transaction->update([
                'sms_charge'=>$pakageUser->pakage->sms_charge,
                'operation_reference'=>$rest['id'],
                'is_send_sms'=>1
                ]);
                }
            return redirect()->intended(route('site.buy.ticket.success',$transaction));
        }catch(\Exception $e){
            dump($e);
            dd($request);
            dd($transaction);
            dd($e);
        }
        
    }
    public function goToMikrotik(Request $request){
        $transaction_id=$request->external_reference;
        $transaction=Transaction::find($transaction_id);
        $ticket =$transaction->ticketWifi()->first();
        $data=$ticket->with(['pakageWifi','pakageWifi.zoneWifis'])->first();
        try{
            return redirect($data->pakageWifi->zoneWifis->captive_gate.'?username='.$ticket->username.'&password='.$ticket->password);
            return redirect()->intended(route('site.buy.ticket.success',$transaction));
        }catch(\Exception $e){
            dump($e);
            dd($request);
            dd($transaction);
            dd($e);
        }
        
    }
    public function backToPayementFailedCampay(Request $request){
       // dd($request->query());
        $transaction_id=$request->input('external_reference');
       // dd($transaction_id);
        $transaction=Transaction::find($transaction_id);
        $ticket =$transaction->ticketWifi()->first();
        
        $data=$ticket->with(['pakageWifi','pakageWifi.zoneWifis'])->first();
        return redirect()->intended(route('site.buy.ticket.success',$transaction));
       //dd($data->pakageWifi->zoneWifis->captive_gate);
        $zoneWifi= $data->pakageWifi->zoneWifis;
        /*$pakageUser=PakageUser::where('user_id',$data->pakageWifi->zoneWifis->user_id)->first();
        if($pakageUser->is_send_message){
            $rest= ApiGateway::sendMessagge($zoneWifi,$ticket,$transaction);
            //dd($rest);
                $transaction->update([
                'is_send_sms'=>1,
                'operation_reference'=>$rest['id'],
                ]);
                //dd($transaction);
            }*/
        $ticket->update([
            'state'=>StateEnum::ACTIVE
        ]);
        $transaction->update([
            'status'=>StateEnum::FAILED
        ]);
        //dd($transaction);
        dd($ticket);
        return redirect($data->pakageWifi->zoneWifis->captive_gate);
        
    }
}
