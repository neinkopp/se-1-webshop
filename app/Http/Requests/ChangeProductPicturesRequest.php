<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ChangeProductPicturesRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'handle' => [
                'required',
                'string',
                'exists:product,handle'
            ],

            'default_pictures.*' => [
                'nullable',
                'image',
                'max:10240'
            ],

            'color_pictures.*.*' => [
                'nullable',
                'image',
                'max:10240'
            ],

            'assets.*.file' => [
                'nullable',
                'file',
                'max:20480'
            ],

            'assets.*.position' => [
                'nullable',
                'string'
            ],
        ];
    }
}
