<?php

namespace App\Http\Controllers;

abstract class Controller
{
    

    public function responseSuccess($data,$message){
        return response()->json([
            'success'=>true,
            'message'=>$message,
            'data'=>$data
           ]);
    }

    public function responseFailed($message){
        return response()->json([
            'success'=>false,
            'message'=>$message,
            'data'=>null
           ]);
    }
}
