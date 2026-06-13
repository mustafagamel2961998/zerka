<?php

namespace App\Http\Requests\Dashboard\V1\Country;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Status;
class CountryRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'status' => $this->has('status') ? 'active' : 'inactive',
        ]);
    }
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
            'iso2'=>['required','string',
                    'regex:/^[a-zA-Z]{2}$/','max:2'],
            'iso3'=>['required','string',
                    'regex:/^[a-zA-Z]{3}$/','max:3'],
            'phone_code'=>['nullable','string','regex:/^\+[0-9]{1,4}$/'],
            'timezone'=>['nullable','string'],
            'status'=>['required',Rule::in(array_column(Status::cases(), 'value'))],
            'name.ar'=>['required','string','max:255'],
            'name.en'=>['required','string','max:255'],

        ];
    }
}  
        
