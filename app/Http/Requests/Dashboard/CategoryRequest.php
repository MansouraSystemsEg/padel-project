<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->route('category') ? $this->route('category')->id : null;
        return [
            'name' => 'required|string|unique:categories,name,' . $id,
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'status' => 'required|in:active,inactive',
            'parent_id' => 'nullable|exists:categories,id',
        ];
        
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'description.string' => 'Description must be a string',
            'image.image' => 'Image must be an image',
            'status.required' => 'Status is required',
            'status.in' => 'Status must be active or inactive',
            'parent_id.exists' => 'Parent category does not exist',
        ];
    }
}
