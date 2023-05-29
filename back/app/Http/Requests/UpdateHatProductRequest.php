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
            'id' => 'required|integer|min:0',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'model' => 'required|string',
            'custom_model_data' => 'required|string'
        ];
    }
}