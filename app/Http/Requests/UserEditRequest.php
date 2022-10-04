<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//       return true;
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'required',
            'email'=> 'required',
            'rols'=> 'required',
            'status'=> 'required',
            'password'=> 'nullable|min:6',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'لطفا نام و نام خانوادگی راوارد نمایید',
            'email.required' => 'لطفا پست الکترونیک راوارد نمایید',
            'rols.required' => 'لطفا نقش کاربر راوارد نمایید',
            'status.required' => 'لطفا وضعیت کاربری راوارد نمایید',
            'password.min' => 'تعداد حروف رمز عبور حداقل 6 کاراکتر است',


        ];
    }
}
