<?php

namespace App\Http\Requests\Dashboard\V1\Category;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Status;
class CategoryRequest extends FormRequest
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
        $id = request('category');
        return [
            'parent_id'=>['nullable','exists:categories,id'],
            'name.ar'=>[
                'required',
                'string',
                'regex:/^[\x{0600}-\x{06FF}0-9\x{0660}-\x{0669}\s]+$/u',
                'max:255',
                Rule::unique('category_translations','name')->where('locale', 'ar')->ignore($id,'category_id')
            ],

            'name.en'=>[
                'required',
                'string',
                'regex:/^[a-zA-Z0-9\s]+$/',
                'max:255',
                Rule::unique('category_translations','name')->where('locale', 'en')->ignore($id,'category_id')
            ],
            'status'=>['required',Rule::in(array_column(Status::cases(), 'value'))],
            'description.ar'=>['nullable','string','max:255'],
            'description.en'=>['nullable','string','max:255'],
            'meta_title.ar'=>['nullable','string','max:60'],
            'meta_title.en'=>['nullable','string','max:60'],
            'meta_description.ar'=>['nullable','string','max:160'],
            'meta_description.en'=>['nullable','string','max:160'],
            'cover'=>[$id ? 'nullable' : 'required','image','mimes:jpg,jpeg,png','max:2048'],
        ];
    }
}
