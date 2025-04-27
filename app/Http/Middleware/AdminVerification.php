<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\ApiResponse;
use Auth;
use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       //dd(auth()->check());
        //$guards = empty($guards) ? [null] : $guards;
        //$user = Auth::user();
        //dd(auth()->check() && auth()->user()->is_admin);
        if (auth()->check() && !(auth()->user()->is_admin)) {
            //dd(auth()->user());
           return throw new HttpResponseException(ApiResponse::error('something went wrong')) ;
        }
        return $next($request);
    }
}
