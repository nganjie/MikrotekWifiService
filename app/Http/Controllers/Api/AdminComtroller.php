<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminComtroller extends Controller
{
    public function index(){
        return ApiResponse::success(auth()->user());
    }
}
