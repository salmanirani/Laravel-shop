<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ResetRequest extends FormRequest
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
            'email'=> 'required',

            'g-recaptcha-response'=> 'required',

        ];
    }

    public function messages()
    {
        return [
            'g-recaptcha-response.required' => 'لطفا تیک ربات را انتخاب کنید نمایید',
            'number.required' => 'لطفا ایمیل  راوارد نمایید',



        ];
    }
}
