<?php
namespace App\Helper;
class FormHelper
{
    public static function response_json($status,$message,$data,$code){
        return response()->json([
            'status'=>$status,
            'message'=>$message,
            'data'=>$data
        ],$code);
    }
}
