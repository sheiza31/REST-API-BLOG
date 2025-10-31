<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
     public function rules(): array
    {
        return [
            'name' => 'sometimes|string',
            'description' => 'sometimes|string',
            'slug' => 'sometimes|string|max:255|unique:categories',
            'parent_id'=>'sometimes|nullable|exists:categories,id',
        ];
    }

    public function messages() : array{
       return [
           'name.required' => 'Name is required',
           'description.required' => 'Description is required',
           'slug.required' => 'Slug is required',
           'parent_id.exists' => 'Parent category does not exist',
       ];
    }
}
