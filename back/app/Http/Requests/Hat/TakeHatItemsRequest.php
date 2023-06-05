<?php

namespace App\Http\Requests\Hat;

use Illuminate\Foundation\Http\FormRequest;

class TakeHatItemsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|string',
            'product_id' => 'required|integer|min:1',
            'count' => 'required|integer|min:1'
        ];
    }
}