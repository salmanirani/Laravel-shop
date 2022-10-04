<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SliderRequest extends FormRequest
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
            'short_desc'=> 'required',
            'description'=> 'required',
            'photo_id'=> 'required',


        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'لطفا عنوان  راوارد نمایید',
            'title.min' => 'حداقل تعداد کارکتر وارد شده برای عنوان 2 کاراکتر میباشد',
            'short_desc.required' => 'لطفا توضیحات کوتاه راوارد نمایید',
            'description.required' => 'لطفا توضیحات  راوارد نمایید',
            'photo_id.required' => 'لطفا لوگو  راوارد نمایید',


        ];
    }
}
