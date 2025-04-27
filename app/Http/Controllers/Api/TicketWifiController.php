<?php

namespace App\Http\Controllers\Api;

use App\Enum\StateEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportTicketwifiRequest;
use App\Models\PakageWifi;
use App\Models\TicketWifi;
use App\Models\User;
use App\Models\ZoneWifi;
use Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use League\Csv\Reader;
use PHPUnit\Framework\Attributes\Ticket;

class TicketWifiController extends Controller
{
    public function index(Request $request){
        try{
            //return $pakageWifi;
            /*$user=User::where('id',Auth::user()->id)->first();
            $tickets = TicketWifi::whereHas('pakageWifi', function ($query) use ($user) {
                $query->whereHas('zoneWifis', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                });
            })->with('pakageWifi')->with('pakageWifi.zoneWifis')->get();*/
            $data=TicketWifi::current($request->input('user_id',null))->latest()->where('state',StateEnum::ACTIVE)->with('pakageWifi')->with('pakageWifi.zoneWifis')->whereRelation('pakageWifi.zoneWifis','user_id',Auth::user()->id)->paginate($request->input('per_page',4));
            //return $data;
            //$data=$pakageWifi->tickets()->latest()->where('state',StateEnum::ACTIVE)->paginate($request->input('per_page',4));
            return ApiResponse::success($data);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function full(Request $request){
        try{
            $data=TicketWifi::current($request->input('user_id',null))->latest()->where('state',StateEnum::ACTIVE)->with('pakageWifi')->with('pakageWifi.zoneWifis')->whereRelation('pakageWifi.zoneWifis','user_id',Auth::user()->id)->latest()->get();
            return ApiResponse::success($data);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function ticketWifis(Request $request,PakageWifi $pakageWifi){
        try{
            $data=$pakageWifi->tickets()->with(['pakageWifi','pakageWifi.zoneWifis'])->paginate($request->input('per_page',4));
           // $data=TicketWifi::latest()->where('state',StateEnum::ACTIVE)->with('pakageWifi')->with('pakageWifi.zoneWifis')->whereRelation('pakageWifi.zoneWifis','user_id',Auth::user()->id)->latest()->get();
            return ApiResponse::success($data);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function storeTickets(ImportTicketwifiRequest $request,PakageWifi $pakageWifi){
        try{
            //dump($zoneWifi);
            //dd(json_encode(['data']));
            //$csv=array_map($request->file('tickets'));
            /*if(Input::file('import_file') ){

            }*/
            $validated=$request->validated();
           // return $validated;
            $file = $request->file('tickets');
           // return $file;
            //dd($file);
            $path = $file->getRealPath();
    
            // Lire et parcourir le contenu du fichier CSV
            $csv = Reader::createFromPath($path, 'r');
            $csv->setHeaderOffset(0); // Si le fichier CSV contient un en-tête
    
            $records = $csv->getRecords(); // Obtenir les enregistrements en tant qu'itérateur
            $tickets=[];
            foreach ($records as $index => $record) {
                $ticket=[];
                // Traitez chaque ligne du fichier CSV
                // Exemple : accès aux colonnes via $record['column_name']
                $ticket['username']=$record['Username'];
                $ticket['password']=$record['Password'];
                $ticket['profile']=$record['Profile'];
                $ticket['time_limit']=$record['Time Limit'];
                $ticket['data_limit']=$record['Data Limit'];
                $ticket['comment']=$record['Comment'];
                //$ticket['zone_wifi_id']=$zoneWifi->id;
                $ticketWifi =new TicketWifi($ticket);
                $pakageWifi->tickets()->save($ticketWifi);
                $tickets[]=$ticketWifi;
                //dump($ticket);
            }
            //dd($zoneWifi->with('tickets')->get());

            return ApiResponse::success($pakageWifi->load('tickets'));
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function delete(TicketWifi $ticketWifi){
        try{
            $ticketWifi->state=StateEnum::DELETED;
            $ticketWifi->update();
            return ApiResponse::success($ticketWifi);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function details(TicketWifi $ticketWifi){
        try{
            $data=TicketWifi::with(['pakageWifi','pakageWifi.zoneWifis'])->find($ticketWifi->id);
            return ApiResponse::success($data);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
}
