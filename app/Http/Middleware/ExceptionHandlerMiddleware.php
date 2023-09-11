<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Exceptions\AccountException;
use Closure;
use Illuminate\Support\Facades\Log;

class ExceptionHandlerMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        try {
            if (!is_null($response->exception)) {
                throw $response->exception;
            }

            return $response;
        } catch (AccountException $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], $e->getStatus());
        }
    }
}
