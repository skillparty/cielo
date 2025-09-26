<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GoogleProfileCompletionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $googleUserId = $this->session()->get('google_onboarding.user_id');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'nullable',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($googleUserId),
            ],
            'phone' => [
                'required',
                'string',
                'min:8',
                'max:20',
                Rule::unique(User::class, 'phone')->ignore($googleUserId),
            ],
            'address_line1' => ['required', 'string', 'max:255'],
            'address_line2' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:120'],
            'state' => ['nullable', 'string', 'max:120'],
            'postal_code' => ['nullable', 'string', 'max:30'],
            'terms' => ['accepted'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => $this->name ? trim($this->name) : $this->name,
            'email' => $this->email ? strtolower(trim($this->email)) : $this->email,
            'phone' => $this->phone ? preg_replace('/\s+/', '', $this->phone) : $this->phone,
            'address_line1' => $this->address_line1 ? trim($this->address_line1) : $this->address_line1,
            'address_line2' => $this->filled('address_line2') ? trim($this->address_line2) : null,
            'city' => $this->filled('city') ? trim($this->city) : null,
            'state' => $this->filled('state') ? trim($this->state) : null,
            'postal_code' => $this->filled('postal_code') ? trim($this->postal_code) : null,
        ]);
    }
}
