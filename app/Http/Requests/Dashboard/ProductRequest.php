<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $id = $this->route('product') ? $this->route('product')->id : null;
        return [
            'name' => 'required|string|unique:products,name,' . $id,
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'status' => 'required|in:active,draft,inactive',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'compare_price' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'rating' => 'nullable|numeric',
            'featured' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name field must be a string.',
            'name.unique' => 'The name field must be unique.',
            'description.string' => 'The description field must be a string.',
            'image.image' => 'The image field must be an image.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The status field must be active or inactive.',
            'category_id.required' => 'The category_id field is required.',
            'category_id.exists' => 'The selected category_id is invalid.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price field must be a number.',
            'compare_price.numeric' => 'The compare price field must be a number.',
            'quantity.required' => 'The quantity field is required.',
            'quantity.integer' => 'The quantity field must be an integer.',
            'quantity.min' => 'The quantity field must be at least 1.',
            'rating.numeric' => 'The rating field must be a number.',
            'featured.boolean' => 'The featured field must be a boolean.',
          ];
    }
}