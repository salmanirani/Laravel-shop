<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        return true;
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
           'password'=> 'required|min:6',
           'rols'=> 'required',
           'status'=> 'required',
           're-password'=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'لطفا نام و نام خانوادگی راوارد نمایید',
            'email.required' => 'لطفا پست الکترونیک راوارد نمایید',
            'password.required' => 'لطفا رمز عبور راوارد نمایید',
            'password.min' => 'تعداد حروف رمز عبور حداقل 6 کاراکتر است',
            'rols.required' => 'لطفا نقش کاربر راوارد نمایید',
            'status.required' => 'لطفا وضعیت کاربری راوارد نمایید',
            're-password.required' => 'لطفا تکرار رمز عبور راوارد نمایید',

        ];
    }
}
