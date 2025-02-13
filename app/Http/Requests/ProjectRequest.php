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
                'status'                   =>'nullable|in:completed,20%,50%,80%,pending' ,
                'description'              =>'required|string|min:10|max:1000',
                'exp_delivery_date'        =>'required|date_format:Y-m-d',
                'delivery_date'            =>'nullable|date',
                'independent_attachments'  =>'nullable|file|mimes:jpg,jpeg,png,gif,doc,docx,pdf|max:2048',
                'customer_attachments'     =>'nullable|file|mimes:jpg,jpeg,png,gif,doc,docx,pdf|max:2048',
                'portfolio_id'             =>'nullable|exists:portfolios,id',
                'client_id'                =>'exists:users,id',
                'section_id'               =>'required|exists:sections,id',
        ];
    }
}
