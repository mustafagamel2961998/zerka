<?php

namespace App\Http\Requests\Front\V1\Checkout;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class CheckoutRequest extends FormRequest
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
            'address_id'=>['required','exists:addresses,id'],
            'payment_method'=>['required','in:cod,wallet'],
            'screen_shot'=>['required_if:payment_method,wallet','mimes:jpg,jpeg,png','max:2048'],
        ];
    }
}
