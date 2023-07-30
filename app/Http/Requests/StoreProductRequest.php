<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => ['required', 'min:3'],
            'category_id' => ['required'],
            'image' => ['required', 'image', 'max:5120'],
            'price' => ['required'],
            'expiration_date' => ['required'],
        ];

        if ($this->method('PUT')) {
            $rules['image'] = [
                'nullable',
                'image',
                'max:5120',
            ];
        }
    }
}
