<?php


namespace App\Components;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

trait SendsResponses
{
    public function success($payload = [])
    {
        return new JsonResponse(
            [
                'success' => true,
                'meta' => $this->getMeta(),
                'payload' => $payload
            ]
        );
    }

    public function error(string $code, string $message)
    {
        return new JsonResponse(
            [
                'success' => false,
                'meta' => $this->getMeta(),
                'payload' => [
                    'code' => $code,
                    'message' => $message
                ]
            ]
        );
    }

    private function getMeta()
    {
        return [
            'user' => Auth::user() ?? [],
        ];
    }
}
