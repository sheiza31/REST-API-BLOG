<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriesRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'slug' => 'string|max:255|unique:categories',
            'parent_id'=>'nullable|exists:categories,id',
        ];
    }

    public function messages() : array{
       return [
           'name.required' => 'Name is required',
           'description.required' => 'Description is required',
           'parent_id.exists' => 'Parent category does not exist',
       ];
    }
}
