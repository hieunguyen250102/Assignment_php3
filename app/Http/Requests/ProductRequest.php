<?php

namespace App\Http\Requests;

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
        return [
            'name' => 'required|unique:product',
            'image' => 'required',
            'image_list' => 'required',
            'description' => 'required',
            'summary' => 'required',
            'price' => 'required|alpha_num',
            'sale_price' => 'alpha_num',
            'tag' => 'required',
            'status' => 'required',
            'category_id' => 'required',
        ];
    }
}
