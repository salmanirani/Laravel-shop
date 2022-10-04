<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
    function str_slug($string) {
        return preg_replace('/\s+/u', '-', trim($string));
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
            'title' => 'required|min:2',
//            'slug'=> 'unique:categories',
//        برای اینکه زمان update به خود اون ای دی گیر نده از دستور زیر برای unique استفاده میکنیم
            'slug'=> Rule::unique('products')->ignore(request()->product),
            'price'=> 'required',
            'brand'=> 'required',
            'categories'=> 'required',
            'attributes'=> 'required',
            'garanty_id'=> 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'لطفا عنوان مطلب راوارد نمایید',
            'title.min' => 'حداقل تعداد کارکتر وارد شده برای عنوان 2 کاراکتر میباشد',
            'price.required' => 'قیمت را وارد نمایید',
            'brand.required' => 'برند  را وارد نمایید',
            'categories.required' => 'دسته بندی را انتخاب نمایید',
            'attributes.required' => 'حداقل یک ویژگی را انتخاب نمایید',
            'garanty_id.required' => 'حداقل یک گارانتی را انتخاب نمایید',
        ];
    }
}
