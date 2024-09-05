<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function handleResponse($result=[], $msg=''){
        $res=[
            'status'=>true,
            'data'=>$result,
            'method'=>$msg,
        ];
        return response()->json($res,200);
    }
    public function handleError($error, $errorMesg=[], $code=400){
        $res=[
            'status'=>false,
            'message'=>$error,
        ];
        if(!empty($errorMesg)){
            $res['data']=$errorMesg;
        }
        return response()->json($res,$code);
    }
}
