<?php

namespace App\Http\Requests\Dashboard\V1\Warehouse;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Status;
class WarehouseRequest extends FormRequest
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
        $id = request('warehouse');
        return [
            'country_id'=>['required','integer','exists:countries,id'],
            'city_id'=>['required','integer','exists:cities,id'],
            'name.ar'=>[
                'required',
                'string',
                'regex:/^[\x{0600}-\x{06FF}0-9\x{0660}-\x{0669}\s]+$/u',
                'max:255',
                 Rule::unique('warehouse_translations','name')->where('locale', 'ar')->ignore($id,'warehouse_id')
            ],

            'name.en'=>[
                'required',
                'string',
                'regex:/^[a-zA-Z0-9\s]+$/',
                'max:255',
                 Rule::unique('warehouse_translations','name')->where('locale', 'en')->ignore($id,'warehouse_id')
            ],
            'description.ar'=>['nullable',
            'string',
            'regex:/^[\x{0600}-\x{06FF}0-9\x{0660}-\x{0669}\s]+$/u',
            'max:255'],

            'description.en'=>['nullable',
            'regex:/^[a-zA-Z0-9\s]+$/',
            'string',
            'max:255'],
            'phone'=>['required','string',Rule::unique('warehouses','phone')->ignore($id)],
            'street_details'=>['nullable','string'],
            'status'=>['required',Rule::in(array_column(Status::cases(), 'value'))],
        ];
    }
}
