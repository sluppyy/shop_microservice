<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHatProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'preview' => 'required|image|mimes:jpeg,jpg,png,gif,svg',
            'price' => 'required|integer|min:0',
            'model' => 'required|string',
            'custom_model_data' => 'required|integer'
        ];
    }
}