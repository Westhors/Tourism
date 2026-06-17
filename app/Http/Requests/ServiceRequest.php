<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // Adjust according to your authorization logic
    }

    public function rules()
    {
        return [
            'title' => 'nullable|string|max:255',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
            'active' => 'nullable|boolean',
        ];
    }
}
