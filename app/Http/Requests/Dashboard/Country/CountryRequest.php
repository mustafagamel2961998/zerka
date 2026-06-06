<?php

namespace App\Http\Requests\Dashboard\Country;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Status;

class CountryRequest extends FormRequest
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
            'currency_id'=>['nullable','exists:currencies,id'],
            'iso2'=>['required','string','max:2'],
            'iso3'=>['required','string','max:3'],
            'phone_code'=>['nullable','string','regex:/^\+[0-9]{1,4}$/'],
            'timezone'=>['nullable','string'],
            // 'status'=>['required',Rule::in(Status::cases())],
            // 'name.ar'=>['required','string'],
            // 'name.en'=>['required','string'],


        ];
    }
}  
        
