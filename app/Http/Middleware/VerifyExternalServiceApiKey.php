<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class VerifyExternalServiceApiKey
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('Authorization');

        if (!$apiKey || !str_starts_with($apiKey, 'Bearer ')) {
            Log::warning('VerifyExternalServiceApiKey: No Authorization header', [
                'ip' => $request->ip(),
                'path' => $request->path(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Invalid API Key',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = substr($apiKey, 7); // Убираем "Bearer "

        $debtorUpdaterKey = config('services.debtor_updater.api_key');
        $meetingApplicationKey = config('services.meeting_application.api_key');

        $isValid = ($debtorUpdaterKey && $token === $debtorUpdaterKey)
            || ($meetingApplicationKey && $token === $meetingApplicationKey);

        if (!$isValid) {
            Log::warning('VerifyExternalServiceApiKey: Invalid API Key', [
                'ip' => $request->ip(),
                'path' => $request->path(),
                'token_preview' => substr($token, 0, 10) . '...',
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Invalid API Key',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
