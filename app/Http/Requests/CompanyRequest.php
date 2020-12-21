<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name'=>'required',
            'address'=>'required',
            'favicon'=>'required',
            'share_icon'=>'required',
            'hotline'=>'required|numeric',
            'email'=>'required|email|max:255',
            'copyright'=>'required',
            'facebook '=>'required',
            'twitter'=>'required',
            'google'=>'required',
            'youtube'=>'required',
            'pinterest'=>'required',
            'instagram'=>'required',
            'iframe_map'=>'required',
            // 'user_id '=>'required|numeric',
            
        ];
    }
}
