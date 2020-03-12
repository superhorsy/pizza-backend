<?php


namespace App\Components;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

trait SendsResponses
{
    public function success($payload = [])
    {
        return new JsonResponse(
            [
                'success' => true,
                'meta'    => Auth::user() ?? [],
                'payload' => $payload
            ]
        );
    }

    public function error(string $code, string $message)
    {
        return new JsonResponse(
            [
                'success' => false,
                'meta'    => Auth::user() ?? [],
                'payload' => [
                    'code'    => $code,
                    'message' => $message
                ]
            ]
        );
    }

}
