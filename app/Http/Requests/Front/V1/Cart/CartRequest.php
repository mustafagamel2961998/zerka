<?php

namespace App\Http\Requests\Front\V1\Cart;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'quantity'=>['required','numeric'],
            'variant_color_id'=>['required','exists:variant_colors,id'],
            'variant_id'=>['required','exists:product_variants,id'],
        ];
    }
}