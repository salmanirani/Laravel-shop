<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AddressRequest extends FormRequest
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
            'address' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'post_code' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'address.required' => 'لطفا آدرس  راوارد نمایید',
            'province_id.required' => 'لطفا استان  راوارد نمایید',
            'city_id.required' => 'لطفا شهر  راوارد نمایید',
            'post_code.required' => 'لطفا کدپستی  راوارد نمایید',
        ];
    }
}
