<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemeRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'organization_id' => ['required', 'exists:organizations'],
            'title' => ['required'],
            'primary' => ['required'],
            'danger' => ['required'],
            'gray' => ['required'],
            'info' => ['required'],
            'success' => ['required'],
            'warning' => ['required'],
            'font' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
