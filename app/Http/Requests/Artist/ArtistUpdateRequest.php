<?php

namespace App\Http\Requests\Artist;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class ArtistUpdateRequest extends FormRequest
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
            'name' => ['string'],
            'password' => ['min:6', 'confirmed', Password::defaults()],
            'location' => [],
            'image' => ['file', 'mimes:png,jpg,jpeg']
        ];
    }
}
