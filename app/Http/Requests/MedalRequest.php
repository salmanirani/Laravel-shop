<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MedalRequest extends FormRequest
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
            'name'=> 'required|min:2',
            'description'=> 'required',
            'photo_id'=> 'required',


        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'لطفا عنوان  راوارد نمایید',
            'name.min' => 'حداقل تعداد کارکتر وارد شده برای عنوان 2 کاراکتر میباشد',
            'description.required' => 'لطفا توضیحات  راوارد نمایید',
            'photo_id.required' => 'لطفا لوگو  راوارد نمایید',


        ];
    }
}
