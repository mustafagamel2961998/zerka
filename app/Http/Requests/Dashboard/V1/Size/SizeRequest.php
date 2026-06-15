<?php

namespace App\Http\Requests\Dashboard\V1\Size;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Status;
class SizeRequest extends FormRequest
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
        $id = request('size');

        return [
            'size'=>['required','string','regex:/^#([A-Fa-f0-9]{6})$/',Rule::unique('sizes','size')->ignore($id,'id')],
            'status'=>['required',Rule::in(array_column(Status::cases(), 'value'))],
        ];
    }
}
