<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            // 'client_id' => 'exists:users,id',
            'project_id' => 'nullable|exists:projects,id',
            'freelancer_id' => 'nullable|exists:users,id',
            'rate' => 'integer|min:1|max:5',
        ];

    }




    public function messages()
{
    return [
        'client_id.required' => 'The client must be specified.',
        'client_id.exists' => 'The specified client does not exist.',
        'freelancer_id.exists' => 'The specified freelancer does not exist.',
        'project_id.exists' => 'The specified project does not exist.',
        'comment.required' => 'A comment is required.',
        'comment.string' => 'The comment must be a string.',
        'comment.max' => 'The comment may not exceed 1000 characters.',
        'rate.required' => 'A rating must be specified.',
        'rate.integer' => 'The rating must be an integer.',
        'rate.min' => 'The rating must be at least 1.',
        'rate.max' => 'The rating may not be greater than 5.',
    ];
}
// public function withValidator($validator)
// {
//     $validator->after(function ($validator) {
//         // التأكد من وجود تعليق أو تقييم على الأقل
//         if (empty($this->comment) && empty($this->rate)) {
//             $validator->errors()->add('review', 'Either comment or rate must be provided');
//         }
//     });
// }
}
