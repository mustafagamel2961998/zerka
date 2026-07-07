<?php

namespace App\Http\Requests\Front\V1\Address;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddressRequest extends FormRequest
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
        $id = request()->route('address');
        return [
            'country_id'=>['required','exists:countries,id'],
            'city_id'=>['required','exists:cities,id'],
            'name'=>['required','string','max:255'],
            'phone'=>['required','string',Rule::unique('addresses','phone')->ignore($id),'max:255'],
            'street_details'=>['required']
        ];
    }
 
}
