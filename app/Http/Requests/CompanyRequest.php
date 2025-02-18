<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name_en' => 'required|string|max:255',
            'name_hi' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email,' . $this->route('company'),
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
        ];
    }

    /**
     * Customize error messages.
     */
    public function messages(): array
    {
        return [
            'name_en.required' => __('messages.company_name_en_required'),
            'name_hi.required' => __('messages.company_name_hi_required'),
            'email.required' => __('messages.company_email_required'),
            'email.email' => __('messages.company_email_valid'),
            'email.unique' => __('messages.company_email_unique'),
            'website.url' => __('messages.company_website_valid'),
            'logo.image' => __('messages.company_logo_image'),
            'logo.mimes' => __('messages.company_logo_mimes'),
            'logo.max' => __('messages.company_logo_max'),
            'logo.dimensions' => __('messages.company_logo_dimensions'),
        ];
    }
}
