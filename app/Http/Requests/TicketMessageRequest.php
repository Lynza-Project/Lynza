<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketMessageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ticket_id' => ['required', 'exists:tickets'],
            'user_id' => ['required', 'exists:users'],
            'content' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
