<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title'        => 'sometimes|required|string|max:255',
            'description'  => 'sometimes|required|string',
            'author'       => 'sometimes|required|string|max:100',
            'isCommmentOn' => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'        => 'عنوان الزامی است.',
            'title.string'          => 'عنوان باید متن باشد.',
            'title.max'             => 'حداکثر طول عنوان ۵۰ کاراکتر است.',
            'description.required'  => 'توضیحات الزامی است.',
            'author.required'       => 'نویسنده الزامی است.',
            'author.string'         => 'نویسنده باید متن باشد.',
            'author.max'            => 'حداکثر طول نام نویسنده ۳۰ کاراکتر است.',
            'isComentOn.boolean'    => 'مقدار isComentOn باید true یا false باشد.',
        ];
    }
}
