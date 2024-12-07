<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name'=>'required',
            'product_price'=>'required|numeric|min:10',
            'product_image'=>'required|file|max:1024',
            'category_id'=>'required',
            'product_stock'=>'required',
            'product_discount'=>'nullable|numeric',
        ];
    }
}
