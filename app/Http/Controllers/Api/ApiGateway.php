<?php

namespace App\Http\Controllers\Api;

use App\Enum\PayementGatewayTypeEnum;
use App\Models\PayementGateway;
use GuzzleHttp\Client;
use Str;

class ApiGateway{
    public static function cinetPayApiCheck($transaction){
        $payementGateway=PayementGateway::where('name',PayementGatewayTypeEnum::CINETPAY->label())->first();
        $data=[
            "apikey"=> $payementGateway->api_key,
            "site_id"=> $payementGateway->site_id,
            "transaction_id"=> $transaction->id , //
            ];
        try{
            $client = new Client();
            $response = $client->post('https://api-checkout.cinetpay.com/v2/payment/check/', [
                'headers' => [
                    'Content-Type'=>'application/json'
                ],
                'json' => $data,
            ]);
            
              $data = json_decode($response->getBody(), true);
              return $data;

        }catch (\Exception $e) {
            // Autres erreurs
            return [
                'error' => 'Erreur inconnue',
                'message' => $e->getMessage(),
            ];
        }
        

    }
    public static function cinetPayApi($pakageWifi,$zoneWifi,$payementGateway,$ticket,$transaction){
        $payementGateway=PayementGateway::where('name',PayementGatewayTypeEnum::CINETPAY->label())->first();
        $return =route('payement.gateway.return.ticket.cinetpay');
        $notify=route('payement.gateway.return.notify.cinetpay');
        //$transaction_id=(string) Str::uuid();
        $data=[
            "apikey"=> $payementGateway->api_key,
            "site_id"=> $payementGateway->site_id,
            "amount"=> $pakageWifi->price,
            "transaction_id"=> $transaction->id , //
            "currency"=> "XAF",
            "description"=> "Payement de ticket Wifi chez".$zoneWifi->name,
            "notify_url"=> $notify,
            "return_url"=> $return,
            "channels"=> "ALL",
            "metadata"=> $ticket->id,
            "lang"=> "FR",
            "lock_phone_number"=> true,
            "customer_phone_number"=> '+237'.$transaction->receiver_number,
            "invoice_data"=> [
              "Somme a payer pour le Ticket"=> $pakageWifi->price,
              "zone wifi"=> $pakageWifi->zoneWifis->name,
              "Entreprise"=> "MikrotekWifi"
        ]];
        try{
            $client = new Client();
            $response = $client->post('https://api-checkout.cinetpay.com/v2/payment/', [
                'headers' => [
                    'Content-Type'=>'application/json'
                ],
                'json' => $data,
            ]);
            
              $data = json_decode($response->getBody(), true);
              return $data;

        }catch (\Exception $e) {
            // Autres erreurs
            return [
                'error' => 'Erreur inconnue',
                'message' => $e->getMessage(),
            ];
        }
        

    }
    public static function camPayApi($pakageWifi,$zoneWifi,$payementGateway,$transaction){
        $payementGateway=PayementGateway::where('name',PayementGatewayTypeEnum::CAMPAY->label())->first();
        $return =route('payement.gateway.return.ticket.campay');
        $failed=route('payement.gateway.return.failed.campay');
       // dd($transaction->receiver_number);
        $data=[
            "amount"=>$pakageWifi->price,
            "external_reference"=> $transaction->id , //
            "currency"=> "XAF",
            "description"=> "Payement de ticket Wifi chez".$zoneWifi->name,
            "failure_redirect_url"=> $failed,
            "from"=>'+237'.$transaction->receiver_number,
            "redirect_url"=> $return,
            "payment_options"=>"momo"
        ];
        try{
            $client = new Client();
            $response = $client->post($payementGateway->url, [
                'headers' => [
                    'Authorization'=> 'Token '.$payementGateway->site_id,
                    'Content-Type'=>'application/json'
                ],
                'json' => $data,
            ]);
            
              $data = json_decode($response->getBody(), true);
              return $data;

        }catch (\Exception $e) {
            dump($transaction->receiver_number);
           dd($e);
            // Autres erreurs
            return [
                'error' => 'Erreur inconnue',
                'message' => $e->getMessage(),
            ];
        }
        
        

    }
    public static function sendMessagge($zoneWifi,$ticket,$transaction){
        try{
            $client = new Client();
            //dd($transaction);
            /*dd([
                "sender"=>$zoneWifi->name,
                "recipient"=>'237'.$transaction->receiver_number,
                "text"=>"Bonjour/Bonsoir Monsieur/Madame, Merci d'avoir acheter un ticket wifi chez ".$zoneWifi->name.". Vos informations de connections. USERNAME :".$ticket->username." Password :".$ticket->password
            ]);*/
            $response = $client->post('https://api.avlytext.com/v1/sms?api_key=oQUXRIJlUoeqtQg5DqrRJZ8V2Q4BjcvTwtEZOtMohfsJCT7EGqmZRTrOAfTGSQIVHmI5', [
                'headers' => [
                    'Content-Type'=>'application/json'
                ],
                'json' => [
                    "sender"=>$zoneWifi->name,
                    "recipient"=>'237'.$transaction->receiver_number,
                    "text"=>"Bonjour/Bonsoir Monsieur/Madame, Merci d'avoir acheter un ticket wifi chez ".$zoneWifi->name.". Vos informations de connections. USERNAME :".$ticket->username." Password :".$ticket->password
                ],
            ]);
            
              $data = json_decode($response->getBody(), true);
              return $data;

        }catch (\Exception $e) {
            // Autres erreurs
            return [
                'error' => 'Erreur inconnue',
                'message' => $e->getMessage(),
            ];
        }
    }
}