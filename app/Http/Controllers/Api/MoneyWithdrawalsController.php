<?php

namespace App\Http\Controllers\Api;

use App\Enum\StateEnum;
use App\Enum\WithdrawalTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\WithdrawalsCreateRequest;
use App\Http\Requests\WithdrawalsUpdateRequest;
use App\Models\MoneyWithdrawal;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\MessageTicketMail;
use Auth;
use DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class MoneyWithdrawalsController extends Controller
{
    public function create(WithdrawalsCreateRequest $request){
        try{
            $validated=$request->validated();
            $nbTransaction=Transaction::current(Auth::user())->where('status',StateEnum::SUCCESS)->doesntHave('moneyWithdrawal')->count();
            //dd($nbTransaction);Auth::user(
            if($nbTransaction==0){
                return ApiResponse::error("impossible de collecter L'argent, Aucun ticket acheter ");
            }
            $amounts=Transaction::current(Auth::user())->where('status',StateEnum::SUCCESS)->doesntHave('moneyWithdrawal')->get()->sum(function ($query) {
                return $query->price + $query->sms_charge;
            });
            //dd(Transaction::current(Auth::user())->where('status',StateEnum::SUCCESS)->doesntHave('moneyWithdrawal')->get());
            DB::beginTransaction();
            
            $transactions=Transaction::current(Auth::user())->where('status',StateEnum::SUCCESS)->doesntHave('moneyWithdrawal')->get();
           
            /*$data=Transaction::whereHas('ticketWifi.pakageWifi.zoneWifis', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })->get();*/
            //dd($data);
            $validated['amount']=$amounts;
            $validated['pakage_type']='ticket';
            $validated['status']=WithdrawalTypeEnum::PENDING->label();
            //dd($validated);
            
           // $moneyWithdrawals=new MoneyWithdrawal($validated);
            $moneyWithdrawals=Auth::user()->moneyWithdrawals()->create($validated);
           // $moneyWithdrawals->transactions()->saveMany($transactions);
            Transaction::current(Auth::user())->where('status',StateEnum::SUCCESS)->update([
                'status'=>WithdrawalTypeEnum::COLLECTED,
                'money_withdrawal_id'=>$moneyWithdrawals->id
            ]);
            $admin=User::where('is_admin',true)->first();
            $user=User::find(Auth::user()->id);
            $admin->notify(new MessageTicketMail([
             'title'=>'Un utilisateur A Fait Une demande de retrait',
             'message'=>"L'utilisateur ".$user->first_name." A fait une demande de Retrait"
            ]));
            
            DB::commit();
            return ApiResponse::success($moneyWithdrawals);
        }catch(\Exception $e){
            DB::rollBack();
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    //private function 
    public function update(WithdrawalsUpdateRequest $request,MoneyWithdrawal $moneyWithdrawals){
        try{
            $validated=$request->validated();
            $moneyWithdrawals->update($validated);
            return ApiResponse::success($moneyWithdrawals);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function details(MoneyWithdrawal $moneyWithdrawal){
        try{
            //$moneyWithdrawals->update($validated);
            //dd($moneyWithdrawal);
            return ApiResponse::success($moneyWithdrawal);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function rejectWithdrawal(WithdrawalsUpdateRequest $request,MoneyWithdrawal $moneyWithdrawal){
        try{
            //$moneyWithdrawals->update($validated);
            $validated=$request->validated();
            $validated['status']=WithdrawalTypeEnum::REJECTED->label();
           // $admin=User::where('is_admin',true)->first();
            $user=User::find($moneyWithdrawal->user_id);
            $user->notify(new MessageTicketMail([
             'title'=>'Reject De La Demande De Retrait',
             'message'=>"L'administrateur a rejeter votre demande de retrait ",
             'remark'=>$validated['remark']
            ]));
            DB::beginTransaction();
            $moneyWithdrawal->transactions()->update([
                'money_withdrawal_id'=>null,
                'status'=>StateEnum::SUCCESS
            ]);
            //$moneyWithdrawal->status=WithdrawalTypeEnum::REJECTED->label();
            $moneyWithdrawal->update($validated);
            DB::commit();
            
            return ApiResponse::success($moneyWithdrawal);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function validWithdrawal(WithdrawalsUpdateRequest $request,MoneyWithdrawal $moneyWithdrawal){
        try{
            //$moneyWithdrawals->update($validated);
            $user=User::find($moneyWithdrawal->user_id);
            $user->notify(new MessageTicketMail([
             'title'=>'Demande De Retrait Valider',
             'message'=>"L'administrateur a Valider votre demande de retrait ",
             'remark'=>'Demande de Retait Valider'
            ]));
            $moneyWithdrawal->status=WithdrawalTypeEnum::COLLECTED->label();
            $moneyWithdrawal->update();
            
            return ApiResponse::success($moneyWithdrawal);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function index(Request $request){
        try{
            //$moneyWithdrawals->update($validated);
            
            $data=MoneyWithdrawal::where('user_id',Auth::user()->id)->latest()->paginate($request->input('per_page',4));
            return ApiResponse::success($data);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function all(Request $request){
        try{
            //$moneyWithdrawals->update($validated);
            
            $data=MoneyWithdrawal::paginate($request->input('per_page',4));
            return ApiResponse::success($data);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
    public function moneyCollect(Request $request){
        try{
            $amounts=Transaction::current(Auth::user())->where('status',StateEnum::SUCCESS)->doesntHave('moneyWithdrawal')->get()->sum(function ($query) {
                return $query->price + $query->sms_charge;
            });
            return ApiResponse::success($amounts);
        }catch(\Exception $e){
            throw new HttpResponseException(ApiResponse::error('something went wrong',$e->getMessage()));
        }
    }
}
