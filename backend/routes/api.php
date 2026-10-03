<?php

use App\Http\Controllers\Api\ComplaintController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json([
        'success' => true,
        'message' => 'Complaint Management API is running.',
        'application' => 'Complaint Management and Citizen Feedback System',
        'environment' => app()->environment(),
    ]);
});

Route::middleware('supabase.auth')->group(function () {
    Route::get('/auth/me', function (Request $request) {
        $user = $request->attributes->get('auth_user');

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'supabase_user_id' => $user->supabase_user_id,
                'name' => trim(
                    $user->first_name . ' ' .
                    ($user->middle_name ? $user->middle_name . ' ' : '') .
                    $user->last_name
                ),
                'email' => $user->email,
                'role' => $user->role?->name,
                'is_active' => $user->is_active,
            ],
        ]);
    });

    Route::post('/complaints', [ComplaintController::class, 'store']);
});
