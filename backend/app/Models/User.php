<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $fillable = [
        'supabase_user_id',
        'role_id',
        'barangay_id',
        'department_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'profile_image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function barangay(): BelongsTo
    {
        return $this->belongsTo(Barangay::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class, 'citizen_id');
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(ComplaintAssignment::class, 'assigned_to');
    }

    public function assignedBy(): HasMany
    {
        return $this->hasMany(ComplaintAssignment::class, 'assigned_by');
    }

    public function complaintUpdates(): HasMany
    {
        return $this->hasMany(ComplaintUpdate::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(ComplaintAttachment::class, 'uploaded_by');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function feedback(): HasMany
    {
        return $this->hasMany(Feedback::class, 'citizen_id');
    }
}