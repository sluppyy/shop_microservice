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
            'id' => 'required|integer|min:0|exists:hat_products,id',
            'name' => 'string',
            'description' => 'string',
            'preview_img_url' => 'nullable|string',
            'price' => 'integer|min:0',
            'model' => 'string',
            'custom_model_data' => 'string'
        ];
    }
}