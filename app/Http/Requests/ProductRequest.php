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
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required',
            'short_content'=>'required',
            'content'=>'required',
            'price'=>'required|numeric',
            'promotion_price'=>'required|numeric',
            'product_media_id'=>'required',
            'tag_id'=>'required',
            'category_id'=>'required',
        ];
    }
}
