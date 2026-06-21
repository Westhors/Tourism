<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageContactUsRequest extends FormRequest
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
        return [
            'phone_one' => 'nullable|string|max:255',
            'phone_two' => 'nullable|string|max:255',
            'work_hours' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:page_contact_us,email',
            'active' => 'boolean',
        ];
    }

}
