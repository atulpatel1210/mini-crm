<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'first_name_en' => 'required|string|max:255',
            'last_name_en' => 'required|string|max:255',
            'first_name_hi' => 'required|string|max:255',
            'last_name_hi' => 'required|string|max:255',
            'email' => 'email|unique:employees,email,' . $this->route('employee'),
            'phone' => 'nullable|digits_between:10,12',
            'company_id' => 'required|exists:companies,id',
        ];
    }

    /**
     * Customize error messages.
     */
    public function messages(): array
    {
        return [
            'first_name_en.required' => __('messages.first_name_en_required'),
            'last_name_en.required' => __('messages.last_name_en_required'),
            'first_name_hi.required' => __('messages.first_name_hi_required'),
            'last_name_hi.required' => __('messages.last_name_hi_required'),
            'email.required' => __('messages.email_required'),
            'email.email' => __('messages.email_valid'),
            'email.unique' => __('messages.email_unique'),
            'phone.digits_between' => __('messages.phone_digits'),
            'company_id.required' => __('messages.company_required'),
        ];
    }
}
