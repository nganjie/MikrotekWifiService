<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    function index(){
        return view('index');
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
            $error=['error'=>$validator->errors()];
            dd($error);
            return redirect()->route('site.index',compact('error'));

        }
        $validated=$validator->safe()->all();
        try{
            Email::create($validated);
        }catch(\Exception $e){
            $error = ['error' => __('Something went wrong! Please try again')];
            //return Response::error($error, null, 500);
            return redirect()->route('site.index',compact('error'));
        }
        $success=['success'=>["Your email subnited"]];
        return redirect()->route('site.index',compact('success'));
    }
}
