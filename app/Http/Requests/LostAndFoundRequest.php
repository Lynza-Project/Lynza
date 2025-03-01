<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LostAndFoundRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'organization_id' => ['required', 'exists:organizations'],
            'title' => ['required'],
            'description' => ['required'],
            'lost_and_found_category_id' => ['required', 'exists:lost_and_found_categories'],
            'location' => ['required'],
            'status' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
