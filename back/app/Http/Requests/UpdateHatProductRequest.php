<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHatProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string',
            'description' => 'string',
            'preview' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg',
            'price' => 'integer|min:0',
            'model' => 'string',
            'custom_model_data' => 'integer'
        ];
    }
}