<?php

namespace App\Http\Requests\Artwork;

use App\Enums\ArtworkCategory;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ArtworkStoreRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'description' => ['required', 'min:55', 'string'],
            'price' => ['required'],
            'category' => ['required', 'string'],
            'image' => ['required', 'file', 'mimes:png,jpg,jpeg']
        ];
    }
}
