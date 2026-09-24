<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class HealthController extends Controller
{
    /**
     * Return application and database health status.
     */
    public function index(): JsonResponse
    {
        $dbStatus = 'connected';
        $dbError = null;

        try {
            DB::connection()->getPdo();
        } catch (\Throwable $e) {
            $dbStatus = 'disconnected';
            $dbError = config('app.debug') ? $e->getMessage() : 'Database connection error';
        }

        $statusCode = ($dbStatus === 'connected') ? 200 : 503;

        $response = [
            'status'          => $dbStatus === 'connected' ? 'ok' : 'degraded',
            'service'         => config('app.name', 'Cana Gardens API'),
            'timestamp'       => now()->toIso8601String(),
            'php_version'     => PHP_VERSION,
            'laravel_version' => app()->version(),
            'environment'     => config('app.env', 'production'),
            'database'        => $dbStatus,
        ];

        if ($dbError) {
            $response['database_error'] = $dbError;
        }

        return response()->json($response, $statusCode);
    }
}
