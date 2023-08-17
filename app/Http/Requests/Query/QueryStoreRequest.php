<?php

namespace App\Http\Requests\Query;

use Illuminate\Foundation\Http\FormRequest;

class QueryStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'client_name' => ['required', 'string'],
            'client_email' => ['required', 'email'],
            'contact_number' => ['required', 'string', 'max:11', 'min:11'],
            'location' => ['required', 'string'],
            'message' => ['required', 'max:255']
        ];
    }
}
