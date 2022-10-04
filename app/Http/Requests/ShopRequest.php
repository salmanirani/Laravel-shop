<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ShopRequest extends FormRequest
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
            'title'=> 'required|min:2',
            'phone'=> 'required',


        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'لطفا عنوان فروشگاه راوارد نمایید',
            'title.min' => 'حداقل تعداد کارکتر وارد شده برای عنوان 2 کاراکتر میباشد',
            'phone.required' => 'لطفا تلفن فروشگاه راوارد نمایید',


        ];
    }
}
