<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultationRequest extends FormRequest
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
            'name'=>['required','string','max:255'],
            'price'=>['required','numeric'],
            'tax'=>['numeric'],
            'status'=>['required','in:active,archived'],
            // 'date.0'=>['required','date']
        ];
    }
    public function messages()
    {
        return [
            // 'date.0.required'=>'يجب ادخال حقل تاريخ علي الاقل'
        ];
    }
}
