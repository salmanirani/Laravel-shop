<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
    public function prepareForValidation()
    {
        if($this->input('slug')){
            $this->merge(['slug'=>str_slug($this->input('slug'))]);
        }else{
            $this->merge(['slug'=>str_slug($this->input('slug'))]);
        }


    }
    public function rules()
    {
        return [
            'title'=> 'required',
//            'slug'=> 'unique:categories',
//        برای اینکه زمان update به خود اون ای دی گیر نده از دستور زیر برای unique استفاده میکنیم
            'slug'=> Rule::unique('categories')->ignore(request()->category),
            'meta_description'=> 'required',
            'meta_keywords'=> 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'لطفا عنوان مطلب راوارد نمایید',
            'slug.unique' => 'نام مستعار باید منحصر به فرد باشد  و قبلا ثبت شده است',
            'meta_description.required' => 'توضیحات متا را وارد نمایید',
            'meta_keywords.required' => 'کلید متا را وارد نمایید',



        ];
    }
}
