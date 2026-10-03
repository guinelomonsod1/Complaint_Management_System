<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreComplaintRequest extends FormRequest
{
    /**
     * Determine if the authenticated user may submit a complaint.
     */
    public function authorize(): bool
    {
        $user = $this->attributes->get('auth_user');

        return $user !== null
            && $user->is_active
            && $user->role?->name === 'Citizen';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'barangay_id' => [
                'required',
                'integer',
                'exists:barangays,id',
            ],

            'category_id' => [
                'required',
                'integer',
                'exists:complaint_categories,id',
            ],

            'subject' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
            ],

            'location' => [
                'nullable',
                'string',
            ],
        ];
    }
}
