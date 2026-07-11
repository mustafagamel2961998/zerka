<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class RegisterRequest extends FormRequest
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
            'country_id'=>['required','exists:countries,id'],
            'city_id'=>['required','exists:cities,id'],
            'first_name'=>['required','string','max:255'],
            'last_name'=>['required','string','max:255'],
            'email'=>['required','string','email','max:255',Rule::unique('users', 'email')],
            'phone'=>['required','string',Rule::unique('users', 'phone')],
            'password'=>['required','string'],
        ];
    }
}
