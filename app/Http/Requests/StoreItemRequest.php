<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'description' => ['nullable', 'string'],
            'category_id' => [
                'required',
                'numeric',
                Rule::exists('categories', 'id')->whereNull('deleted_at')
            ],
            'sub_category_id' => [
                'numeric',
                Rule::exists('sub_categories', 'id')->whereNull('deleted_at')
            ]
        ];
    }
}
