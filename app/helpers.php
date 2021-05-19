<?php

function responseJson($status,$message,$data=null)
{
    $response=[
        'status'=>$status,
        'msg'=>$message,
        'data'=>$data
    ];
    return response()->json($response);

}