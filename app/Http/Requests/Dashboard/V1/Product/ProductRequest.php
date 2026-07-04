<?php

namespace App\Http\Requests\Dashboard\V1\Product;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Status;
class ProductRequest extends FormRequest
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
        $id = request('product');
        return [
            'category_id'=>[
                'required',
                'exists:categories,id'
            ],
            'name.ar'=>[
                'required',
                'string',
                'regex:/^[\x{0600}-\x{06FF}0-9\x{0660}-\x{0669}\s]+$/u','max:255',
                Rule::unique('product_translations','name')->where('locale', 'ar')->ignore($id,'product_id')
            ],
            'name.en'=>[
                'required',
                'string',
                'regex:/^[a-zA-Z0-9\s\-_]+$/','max:255',
                Rule::unique('product_translations','name')->where('locale', 'en')->ignore($id,'product_id')
            ],

            'description.ar'=>[
                'nullable',
                'string',
                'regex:/^[\x{0600}-\x{06FF}0-9\x{0660}-\x{0669}\s]+$/u'
            ],
            'description.en'=>[
                'nullable',
                'string',
                'regex:/^[a-zA-Z0-9\s\-_]+$/u'
            ],
            'long_description.ar'=>[
                'nullable',
                'string',
                'regex:/^[\x{0600}-\x{06FF}0-9\x{0660}-\x{0669}\s]+$/u'
            ],
            'long_description.en'=>[
                'nullable',
                'string',
                'regex:/^[a-zA-Z0-9\s\-_]+$/u'
            ],
            
            'meta_title.ar'=>[
                'nullable',
                'string',
                'max:255',
                'regex:/^[\x{0600}-\x{06FF}0-9\x{0660}-\x{0669}\s]+$/u'
            ],
            'meta_title.en'=>[
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9\s\-_]+$/u'
            ],

            'meta_description.ar'=>[
                'nullable',
                'string',
                'regex:/^[\x{0600}-\x{06FF}0-9\x{0660}-\x{0669}\s]+$/u'
            ],
            'meta_description.en'=>[
                'nullable',
                'string',
                'regex:/^[a-zA-Z0-9\s\-_]+$/u'
            ],

            'images' => [
                $id ? 'nullable' : 'required',
                'array' 
            ],
            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048' 
            ],            
            'variants' => [
                'required', 
                'array', 
                'min:1'
            ],
            'variants.*.size_id' => [
                'required', 
                'exists:sizes,id'
            ],
            'variants.*.color_id' => [
                'required',
                'exists:colors,id'
            ],
            // 'variants.*.colors' => [
            //     'required',
            //     'array',
            //     'min:1'
            // ],
            // 'variants.*.colors.*' => [
            //     'required',
            //     'exists:colors,id'
            // ],
            'variants.*.warehouse_id' => [
                'required', 
                'exists:warehouses,id'
            ],
            'variants.*.price' => [
                'required', 
                'numeric', 
                'min:0'
            ],
            'variants.*.quantity' => [
                'required', 
                'integer', 
                'min:0'
            ],
            'variants.*.minimum_quantity' => [
                'required', 
                'integer', 
                'min:0'
            ],
           
            'status'=>['required',Rule::in(array_column(Status::cases(), 'value'))],

        ];
    }
}
