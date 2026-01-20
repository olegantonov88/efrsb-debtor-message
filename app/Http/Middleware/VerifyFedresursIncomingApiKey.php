<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class VerifyFedresursIncomingApiKey
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('Authorization');

        if ($apiKey !== 'Bearer ' . config('services.fedresurs_message_list.incoming_api_key')) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid API Key',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}


