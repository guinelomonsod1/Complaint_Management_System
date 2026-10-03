<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComplaintRequest;
use App\Models\Complaint;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ComplaintController extends Controller
{
    /**
     * Store a newly submitted complaint.
     */
    public function store(StoreComplaintRequest $request): JsonResponse
    {
        $user = $request->attributes->get('auth_user');

        $complaint = DB::transaction(function () use ($request, $user) {
            $trackingNumber = $this->generateTrackingNumber();

            return Complaint::create([
                'tracking_number' => $trackingNumber,
                'citizen_id' => $user->id,
                'barangay_id' => $request->integer('barangay_id'),
                'department_id' => null,
                'category_id' => $request->integer('category_id'),
                'priority_id' => null,
                'subject' => $request->string('subject')->toString(),
                'description' => $request->string('description')->toString(),
                'location' => $request->input('location'),
                'status' => 'SUBMITTED',
                'submitted_at' => now(),
                'resolved_at' => null,
            ]);
        });

        $complaint->load([
            'barangay',
            'category',
            'priority',
            'department',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Complaint submitted successfully.',
            'data' => $complaint,
        ], 201);
    }

    /**
     * Generate a unique complaint tracking number.
     */
    private function generateTrackingNumber(): string
    {
        $date = now()->format('Ymd');

        $lastComplaint = Complaint::whereDate('submitted_at', today())
            ->orderByDesc('id')
            ->first();

        $sequence = $lastComplaint
            ? ((int) substr($lastComplaint->tracking_number, -4)) + 1
            : 1;

        return sprintf(
            'CMP-%s-%04d',
            $date,
            $sequence
        );
    }
}
