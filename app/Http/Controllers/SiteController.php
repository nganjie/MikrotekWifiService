<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\SendParentEmailNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    function index() :View{
        $message="Your email submited";
        return view('index',['message'=>$message]);
    }
    public function showSignup(){
        return view('signup');
    }
    public function showSucessTicket(Request $request,Transaction $transaction){
        //dd($transaction);
        $data=session()->get('data');
        $ticket =$transaction->ticketWifi()->first();
        $data=$ticket->with(['pakageWifi','pakageWifi.zoneWifis'])->first();
        $zoneWifi= $data->pakageWifi->zoneWifis;
        return view('response-ticket',[
            'transaction'=>$transaction,
            'ticket'=>$ticket,
            'type'=>'SUCCESS',
            'zoneWifi'=>$zoneWifi,
            'data'=>$data
        ]);
    }
    public function showFailedTicket(Request $request,Transaction $transaction){
        //dd($transaction);
        $data=session()->get('data');
       // dd($data);
        $ticket =$transaction->ticketWifi()->first();
        return view('response-ticket',[
            'transaction'=>$transaction,
            'ticket'=>$ticket,
            'type'=>'FAILED',
            'data'=>$data
        ]);
    }
    public function downloadTicket(Request $request,Transaction $transaction){
       // dd($transaction);
       try{
        $data=session()->get('data');
        $ticket =$transaction->ticketWifi()->first();
        //dd($ticket);
        $data=$ticket->with(['pakageWifi','pakageWifi.zoneWifis'])->first();
        $zoneWifi= $data->pakageWifi->zoneWifis;
        $pdf = Pdf::loadView('ticket', [
            'transaction'=>$transaction,
            'ticket'=>$ticket,
            'type'=>'SUCCESS',
            'zoneWifi'=>$zoneWifi,
            'data'=>$data
        ]);
       
        return $pdf->download('itsolutionstuff.pdf');
        return redirect()->back();
       }catch(\Exception $e){
        dd($e);
       }
        
    }
    public function createAccount(Request $request){
       // dd($request);
        $validator=Validator::make($request->all(),[
            'first_name'=>'required',
            'last_name'=>'required',
            'city'=>'required',
            'country'=>'required',
            'country_code'=>'required',
            'email'=>'required|unique:users',
            'number'=>'required|phone:contry_code|unique:users',
            'password'=>'required',
            'confirm-password'=>'required'
        ]);
        
        if($validator->stopOnFirstFailure()->fails()){
            //$error=['error'=>$validator->errors()];
            //dd($validator->errors());
            return back()->with(['error'=>$validator->errors()]);

        }
        //dd($validator);
        
        if($request['password']!==$request['confirm-password']){
            return back()->with(['warn'=>__("site.passwords are not identical")]);
        }
        //dd($validator);
        $validated =$validator->safe()->except(['country_code','confirm-password']);
        
        //dd($validated);
        $validated['password'] = Hash::make($validated['password']);
        //dd($validated);
        $user=User::create($validated);
        if($user){
           // $user->notify(new SendParentEmailNotification($user->first_name,'createuser'));
        }
        $email =$request['email'];
        $success=['success'=>__("site.your account has been created successfully. Please log in to your email , account to have your connection information",['realemail'=>$email])];
        return back()->with($success);
    }
    public function changeLanguage(string $lang){
        //dd($lang);
        if (in_array($lang, ['en', 'fr'])) {
            //dd($lang);
            App::setLocale($lang);
            session(['locale' => $lang]); // Enregistrer la langue dans la session
        }
        //dd(Session::get('lang'));
        return redirect()->back();
    }
    function submitEmail(Request $request){
       // dd($request);
       $validator=Validator::make($request->all(),[
            "first_name"=>"required",
            "last_name"=>"required",
            "subject"=>"required",
            "email"=>"required|email",
            "message"=>"required",
        ]);

        if($validator->stopOnFirstFailure()->fails()){
            //$error=['error'=>$validator->errors()];
            //dd($validator->errors());
            return back()->with(['error'=>$validator->errors()]);

        }
        $validated=$validator->safe()->all();
        $user=User::where('is_admin',true)->first();
            //dd($user);
        try{
            Email::create($validated);
            
            if($user)
            $user->notify(new SendParentEmailNotification($request['first_name'],'sendcontact'));
        }catch(\Exception $e){
            //dd($user);
           // dd($e);
            $error = ['error' => __('Something went wrong! Please try again')];
            //return Response::error($error, null, 500);
            return back()->with(['errors'=>$error]);
        }
        $success=['success'=>__("site.your email has been sent successfully")];
        return back()->with($success);
        //return redirect()->route('site.index',['message'=>'Your email submited']);
    }
    public function backToPayement(Request $request){
        dd($request);
    }
}
