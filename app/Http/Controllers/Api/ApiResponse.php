<?php

namespace App\Http\Controllers\Api;
class ApiResponse{
    public static function unauthorized($data, $message = null)
    {
        return response()->json([ 'data' => $data, 'message' => $message,'success'=>false], 401);
    }
    public static function success($data,$message = null)
    {
        return response()->json([ 'message' => $message,'data' => $data,'success'=>true], 200);
    }
    public static function onlysuccess($message = null)
    {
        return response()->json([ 'message' => $message,'success'=>true], 200);
    }

    public static function no_content($message = 'No Data Found')
    {
        return response()->json(['data' => null, 'message' => $message,'success'=>false], 204);
    }

    public static function created($message = 'Data Created', $data = null)
    {
        return response()->json([ 'message' => $message, 'data' => $data,'success'=>true], 201);
    }

    public static function updated($message = 'Data Updated', $data = null)
    {
        return response()->json(['message' => $message,'data' => $data,'success'=>true], 202);
    }

    public static function deleted($message = 'Data Deleted', $data = null)
    {
        return response()->json(['data' => $data, 'message' => $message], 202);
    }

    public static function error($message = 'Something Went Wrong', $data = null)
    {
        return response()->json(['data' => $data, 'message' => $message,'success'=>false], 400);
    }

    public static function validation($message = 'Invalid Submission', $data = null)
    {
        return response()->json(['data' => $data, 'message' => $message,'success'=>false], 422);
    }
    public static function maintenance($message = 'Something Went Wrong', $data = null)
    {
        return response()->json(['message' => $message,'data' => $data,'success'=>true], 503);
    }
}