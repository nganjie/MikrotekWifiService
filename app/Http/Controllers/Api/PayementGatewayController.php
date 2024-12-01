<?php

namespace App\Http\Controllers\Api;

use App\Enum\StateEnum;
use App\Http\Controllers\Controller;
use App\Models\PakageWifi;
use App\Models\PayementGateway;
use App\Models\TicketWifi;
use App\Models\Transaction;
use App\Notifications\SendParentEmailNotification;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Str;

class PayementGatewayController extends Controller
{
    public function buyTicket(Request $request,PakageWifi $pakageWifi,int $amount){
        try{
            $transaction_id=(string) Str::uuid();
       $ticket =$pakageWifi->tickets()->where('state',StateEnum::ACTIVE)->first();
        $pakageWifi->load('zoneWifis');
        $payementGateway=PayementGateway::first();
        $zone=$pakageWifi->load(['zoneWifis','zoneWifis.user']);
        $user=$zone->zoneWifis->user;
        $return =route('payement.return.ticket');
        $notify=route('admin.payement.gateway.return.notify');
        //dd($notify);
        //dd($user->zoneWifis->user);
        /*$curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.restful-api.dev/objects',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 60,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_SSL_VERIFYPEER=>true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>json_encode([
                 "apikey"=> $payementGateway->api_key,
            "site_id"=> $payementGateway->site_id,
            "transaction_id"=> $transaction_id , //
            "amount"=> $amount,
            "currency"=> "XOF",
            "alternative_currency"=> "",
            "description"=> " TEST INTEGRATION ",
            "notify_url"=> "https://webhook.site/d1dbbb89-52c7-49af-a689-b3c412df820d",
            "return_url"=> "https://webhook.site/d1dbbb89-52c7-49af-a689-b3c412df820d",
            "channels"=> "ALL",
            "metadata"=> $ticket->id,
            "lang"=> "FR",
            "invoice_data"=> [
              "Donnee1"=> "Payer le Ticket Wifi de  :".$pakageWifi->price,
              "Donnee2"=> "zone wifi".$pakageWifi->zoneWifis->name,
              "Donnee3"=> ""
            ]
              ]),
                    CURLOPT_HTTPHEADER =>[
                "Accept: application/json",
              ],
                ));

                $response = json_decode(curl_exec($curl), true);
                curl_close($curl);
                dd($response);*/
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->get('https://api.restful-api.dev/objects', [
            "apikey"=> $payementGateway->api_key,
            "site_id"=> $payementGateway->site_id,
            "transaction_id"=> $transaction_id , //
            "amount"=> $amount,
            "currency"=> "XOF",
            "description"=> "Payement de ticket Wifi ",
            "notify_url"=> $notify,
            "return_url"=> $return,
            "channels"=> "ALL",
            "metadata"=> $ticket->id,
            "lang"=> "FR",
            "invoice_data"=> [
              "Somme a payer pour le Ticket"=> $pakageWifi->price,
              "zone wifi"=> $pakageWifi->zoneWifis->name,
              "Entreprise"=> "MikrotekWifi"
        ]
      
        ]);
        
        if ($response->successful()) {
            dd($response);
            if(true)//if(isset($response['code'])&&$response['code']=='201')
            {
                $ticket->state=StateEnum::PENDING;
                
                $transaction=new Transaction([
                    'type'=>'ticket',
                    'status'=>StateEnum::PENDING,
                    'price'=>$amount,
                ]);
                $ticket->transaction()->save($transaction);
                $ticket->update();
                //$user->notify(new SendParentEmailNotification('transactions mails'));
                

                return ApiResponse::success($ticket);
            }else{
                return ApiResponse::error(__("une erreur s'est produite"));
            }
        }else{
            return ApiResponse::error();
        }
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
        
    }
}
