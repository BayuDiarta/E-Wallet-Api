<?php

namespace App\Traits;

trait Response {
    
    protected static $response = [
        'meta' => [
            'code' => 200,
            'status' => 'success',
            'message' => null
        ],
        'data' => null
    ];
    
    public function successResponse($data = null, $message = null, $code = 200)
    {
        self::$response['meta']['message'] = $message;
        self::$response['meta']['status'] = 'success';
        self::$response['meta']['code'] = $code;
        self::$response['data'] = $data;
        
        return response()->json(self::$response, self::$response['meta']['code']);
    }
    
    public function errorResponse($data = null, $message = null, $code)
    {
        self::$response['meta']['status'] = 'error';
        self::$response['meta']['code'] = $code;
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;
        return response()->json(self::$response, self::$response['meta']['code']);
    }
}