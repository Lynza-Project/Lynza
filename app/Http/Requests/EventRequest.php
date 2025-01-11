<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'organization_id' => ['required', 'exists:organizations'],
            'user_id' => ['required', 'exists:users'],
            'title' => ['required'],
            'description' => ['required'],
            'date' => ['required', 'date'],
            'location' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
