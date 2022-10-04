<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PostEditRequest extends FormRequest
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
            'title'=> 'required|min:5',
//            'slug'=> 'unique:posts',
            'slug'=> Rule::unique('posts')->ignore(request()->post),
            'description'=> 'required',
            'meta_description'=> 'required',
            'category'=> 'nullable',
            'status'=> 'nullable',

        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'لطفا عنوان مطلب راوارد نمایید',
            'title.min' => 'حداقل تعداد کارکتر وارد شده برای عنوان 5 کاراکتر میباشد',
            'slug.unique' => 'نام مستعار باید منحصر به فرد باشد  و قبلا ثبت شده است',
            'description.required' => 'لطفا توضیحات مطلب راوارد نمایید',
            'meta_description.required' => 'لطفا توضیحات متا راوارد نمایید',
            'category.required' => 'لطفا دسته بندی راوارد نمایید',
            'status.min' => 'لطفا وضعیت را فعال نمایید',


        ];
    }
}
