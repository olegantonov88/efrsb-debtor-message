<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class VerifyDebtorUpdaterApiKey
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('Authorization');

        // Убираем префикс 'Bearer ' если он есть
        $cleanApiKey = $apiKey ? preg_replace('/^Bearer\s+/i', '', $apiKey) : null;
        $expectedKey = config('services.debtor_updater.api_key');

        if (!$cleanApiKey || $cleanApiKey !== $expectedKey) {
            Log::warning('VerifyDebtorUpdaterApiKey: Invalid API Key', [
                'ip' => $request->ip(),
                'path' => $request->path(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Invalid API Key',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
