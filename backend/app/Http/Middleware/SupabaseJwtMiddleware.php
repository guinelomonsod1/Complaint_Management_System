<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class SupabaseJwtMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $authorization = $request->header('Authorization');

        if (! $authorization || ! str_starts_with($authorization, 'Bearer ')) {
            return response()->json([
                'success' => false,
                'message' => 'Missing or invalid Authorization header.',
            ], 401);
        }

        $token = substr($authorization, 7);

        try {
            $supabaseUrl = config('services.supabase.url');

            if (! $supabaseUrl) {
                return response()->json([
                    'success' => false,
                    'message' => 'Supabase authentication is not configured.',
                ], 500);
            }

            $jwksUrl = rtrim($supabaseUrl, '/')
                . '/auth/v1/.well-known/jwks.json';

            $jwksResponse = file_get_contents($jwksUrl);

            if ($jwksResponse === false) {
                throw new \RuntimeException(
                    'Unable to retrieve Supabase JWKS.'
                );
            }

            $jwks = json_decode($jwksResponse, true);

            if (! is_array($jwks)) {
                throw new \RuntimeException(
                    'Invalid Supabase JWKS response.'
                );
            }

            $keys = JWK::parseKeySet($jwks);

            $claims = JWT::decode($token, $keys);

            $issuer = rtrim($supabaseUrl, '/') . '/auth/v1';

            if (($claims->iss ?? null) !== $issuer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid token issuer.',
                ], 401);
            }

            if (empty($claims->sub)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token does not contain a user ID.',
                ], 401);
            }

            $user = User::where(
                'supabase_user_id',
                $claims->sub
            )->first();

            if (! $user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Authenticated Supabase user is not registered in the application.',
                ], 403);
            }

            if (! $user->is_active) {
                return response()->json([
                    'success' => false,
                    'message' => 'User account is inactive.',
                ], 403);
            }

            $request->attributes->set('auth_user', $user);
            $request->attributes->set('supabase_claims', $claims);

            return $next($request);

        } catch (Throwable $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired authentication token.',
            ], 401);
        }
    }
}