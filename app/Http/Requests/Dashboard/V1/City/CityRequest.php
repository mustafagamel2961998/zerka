<?php

namespace App\Http\Requests\Dashboard\V1\City;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Status;

class CityRequest extends FormRequest
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
            'country_id'=>['required','exists:countries,id'],
            'status'=>['required',Rule::in(array_column(Status::cases(), 'value'))],
            'name.ar'=>['required','string','max:255'],
            'name.en'=>['required','string','max:255'],
        ];
    }
}
