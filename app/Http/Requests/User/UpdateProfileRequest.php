<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name'=>'max:255',
            'phone_no'=>'integer',
            'image'=>'mimes:jpeg,png',
            'permanent_street'=>'required',
            'permanent_landmark'=>'required',
            'permanent_state'=>'required',
            'permanent_country'=>'required',
            'permanent_police'=>'required',
            'permanent_post'=>'required',
            'permanent_pincode'=>'integer|digits:6',
            'current_street'=>'required',
            'current_landmark'=>'required',
            'current_state'=>'required',
            'current_country'=>'required',
            'current_police'=>'required',
            'current_post'=>'required',
            'current_pincode'=>'integer|digits:6'
        ];
    }
}
