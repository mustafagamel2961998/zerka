<?php

namespace App\Http\Requests\Dashboard\V1\Setting;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'currency_id'=>['required','exists:currencies,id'],
            'country_id'=>['required','exists:countries,id'],
            'name.ar'=>['required',
            'string',
            'regex:/^[\x{0600}-\x{06FF}0-9\x{0660}-\x{0669}\s]+$/u',
            'max:255'],
            'name.en'=>['required',
            'string',
            'regex:/^[a-zA-Z0-9\s]+$/',
            'max:255'],
            'email'=>['required','string','email','max:255'],
            'phone'=>['required','string','max:255'],
            'tax_percentage'=>['required','integer','min:0','max:100'],
            'shipping_amount'=>['required','numeric','min:0'],
            'logo'=>['nullable','image','mimes:jpg,jpeg,png'],
        ];
    }
}
