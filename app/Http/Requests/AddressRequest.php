<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'organization_id' => ['required', 'exists:organizations'],
            'number' => ['required'],
            'name' => ['required'],
            'zip_code' => ['required', 'integer'],
            'country' => ['required'],
            'region' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
