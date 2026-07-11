<?php

namespace App\Http\Requests\Dashboard\V1\Refund;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Refund\RefundStatus;
use Illuminate\Validation\Rule;
class UpdateRefundRequest extends FormRequest
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
            'status'=>['required',Rule::in(array_column(RefundStatus::cases(), 'value'))],
        ];
    }
}
