<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
                'name'                     =>'required|string|min:3|max:255|unique:projects,name',
                'status'                   =>'required|in:completed,20%,50%,80%,pending' ,
                'description'              =>'required|string|min:10|max:1000',
                'exp_delivery_date'        =>'required|date',
                'delivery_date'            =>'required|date',
                'independent_attachments'  =>'nullable|file|mimes:jpg,jpeg,png,gif,doc,docx,pdf|max:2048',
                'customer_attachments'     =>'nullable|file|mimes:jpg,jpeg,png,gif,doc,docx,pdf|max:2048',
                'portfolio_id'             =>'required|exists:portfolios,id',
                'user_id'                  =>'required|exists:users,id',
                'section_id'               =>'required|exists:sections,id',
        ];
    }
}
