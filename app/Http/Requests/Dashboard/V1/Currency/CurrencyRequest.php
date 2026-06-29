<?php

namespace App\Http\Requests\Dashboard\V1\Currency;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Status;
class CurrencyRequest extends FormRequest
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
        $id = request('currency');
        return [
            'code'=>['required','string','regex:/^[A-Z]{3}$/','max:3',Rule::unique('currencies', 'code')->ignore($id)],
            'exchange_rate'=>['required','numeric'],
            'decimal_places'=>['required','numeric'],
            'status'=>['required',Rule::in(array_column(Status::cases(), 'value'))],
            'name.ar'=>['required',
            'string',
            'regex:/^[\x{0600}-\x{06FF}0-9\x{0660}-\x{0669}\s]+$/u',
            'max:255'],
            'name.en'=>['required',
            'string',
            'regex:/^[a-zA-Z0-9\s]+$/',
            'max:255'],
            'symbol.ar'=>['required',
            'string',
            'regex:/^[\x{0600}-\x{06FF}0-9\x{0660}-\x{0669}\s\.]+$/u',
            'max:255'],
            'symbol.en'=>['required',
            'string',
            'regex:/^[a-zA-Z0-9\s]+$/',
            'max:255'],

        ];
    }
}
