<?php

namespace App\Http\Requests;

use App\Brand;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        return false;
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
            'slug'=> Rule::unique('title')->ignore(request()->title),
//          'title'=> 'required|unique:brands',
            'description'=> 'required',
            'photo_id'=> 'required',

        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'لطفا عنوان برند  راوارد نمایید',
            'title.unique' => 'ابن برند قبلا ثبت شده است .در صورت اشکال با پشتیبانی تماس حاصل فرمایید',
            'description.required' => 'لطفا توضیحاتی برای برند وارد نمایید',
            'photo_id.required' => 'لطفا عکسی برای برند وارد نمایید',

        ];
    }
}
