<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FrontRegisterUserRequest extends FormRequest
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
            'name'=> 'required',
            'email'=> 'required',
            'email'=> 'required|'.Rule::unique('users')->ignore(request()->email),
            'last_name'=> 'required',
            'password'=> 'nullable|min:6',
            'g-recaptcha-response'=> 'required',

        ];
    }

    public function messages()
    {
        return [
            'g-recaptcha-response.required' => 'لطفا تیک ربات را انتخاب کنید نمایید',
            'name.required' => 'لطفا نام  راوارد نمایید',
            'email.required' => 'لطفا ایمیل  راوارد نمایید',
            'email.unique' => 'ایمیل باید منحصر به فرد باشد  و قبلا ثبت شده است',
            'last_name.required' => 'لطفا  نام خانوادگی راوارد نمایید',
            'email.required' => 'لطفا پست الکترونیک راوارد نمایید',
            'password.min' => 'تعداد حروف رمز عبور حداقل 6 کاراکتر است',


        ];
    }
}
