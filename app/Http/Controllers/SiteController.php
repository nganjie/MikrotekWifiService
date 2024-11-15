<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    function index() :View{
        $message="Your email submited";
        return view('index',['message'=>$message]);
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
       /* $validator=Validator::make($request->all(),[
            "first_name"=>"required",
            "last_name"=>"required",
            "subject"=>"required",
            "email"=>"required|email",
            "message"=>"required",
        ]);

        if($validator->stopOnFirstFailure()->fails()){
            $error=['error'=>$validator->errors()];
            //dd($error);
            return redirect()->route('site.index',['message'=>$error]);

        }
        $validated=$validator->safe()->all();
        try{
            Email::create($validated);
        }catch(\Exception $e){
            $error = ['error' => __('Something went wrong! Please try again')];
            //return Response::error($error, null, 500);
            return redirect()->route('site.index',['error'=>$error]);
        }*/
        $success=['success'=>["Your email subnited"]];
        return back()->with(['message'=>'Your email submited']);
        //return redirect()->route('site.index',['message'=>'Your email submited']);
    }
}
