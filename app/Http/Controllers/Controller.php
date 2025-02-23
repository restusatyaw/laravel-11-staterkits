<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public static function responseJson($code, $status, $message, $data) {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data ?? null
        ], $code);
    }
}
