<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;


class BaseController extends Controller{
public function sendResponse($response, $status ="success", $code = 200){
    return response()->json([
        'status' => $status,
        'data' => $response
    ], $code);  
        
}
}