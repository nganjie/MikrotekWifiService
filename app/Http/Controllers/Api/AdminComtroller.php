<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class AdminComtroller extends Controller
{
    public function index(){
        return ApiResponse::success(Auth::user());
    }
}
