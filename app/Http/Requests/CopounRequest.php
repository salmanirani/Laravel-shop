<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CopounRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'title' => 'required|min:2',
            'code' => 'required',
            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'لطفا عنوان  راوارد نمایید',
            'title.min' => 'حداقل تعداد کارکتر وارد شده برای عنوان 2 کاراکتر میباشد',
            'code.required' => 'لطفا کد  راوارد نمایید',
            'price.required' => 'لطفا قیمت  راوارد نمایید',

        ];
    }
}
