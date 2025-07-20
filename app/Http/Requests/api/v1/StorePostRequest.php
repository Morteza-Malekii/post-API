<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'      =>  'required|max:50|string' ,
            'description'=>  'required' ,
            'author'     =>  'required|max:30|string ' ,
            'isComentOn' =>  'boolean' ,
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'        => 'عنوان الزامی است.',
            'title.string'          => 'عنوان باید متن باشد.',
            'title.max'             => 'حداکثر طول عنوان ۵۰ کاراکتر است.',
            'description.required'  => 'توضیحات الزامی است.',
            'description.string'    => 'توضیحات باید متن باشد.',
            'author.required'       => 'نویسنده الزامی است.',
            'author.string'         => 'نام نویسنده باید متن باشد.',
            'author.max'            => 'حداکثر طول نام نویسنده ۳۰ کاراکتر است.',
            'isComentOn.boolean'    => 'مقدار isComentOn باید true یا false باشد.',
        ];
    }
}
