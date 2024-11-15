<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //dd(Session::get('locale'));
        if ( Session::has('locale')) {
            // Récupération de la 'lang' dans Session et activation
            App::setLocale(\Session::get('locale'));
            //dd([1,2,3,3]);
        }
        return $next($request);
    }
}
