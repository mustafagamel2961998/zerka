<?php

namespace App\Http\Requests\Dashboard\V1\Category;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Status;
use Illuminate\Support\Facades\DB;

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
            'name.ar' => [
                    'required',
                    'string',
                    'regex:/^[\x{0600}-\x{06FF}0-9\x{0660}-\x{0669}\s]+$/u',
                    'max:255',
                    function ($attribute, $value, $fail) use ($id) {
                        $exists = DB::table('category_translations')
                            ->join('categories', 'categories.id', '=', 'category_translations.category_id')
                            ->where('category_translations.locale', 'ar')
                            ->where('category_translations.name', $value)
                            ->where('categories.parent_id', $this->parent_id)
                            ->when($id, function ($query) use ($id) {
                                return $query->where('category_translations.category_id', '!=', $id);
                            })
                            ->exists();

                        if ($exists) {
                            $fail('اسم التصنيف هذا مستخدم بالفعل داخل هذا التصنيف الأب.');
                        }
                 }
                ],
                'name.en' => [
                    'required',
                    'string',
                    'regex:/^[a-zA-Z0-9\s\-]+$/',
                    'max:255',
                     function ($attribute, $value, $fail) use ($id) {
                        $exists = DB::table('category_translations')
                            ->join('categories', 'categories.id', '=', 'category_translations.category_id')
                            ->where('category_translations.locale', 'en')
                            ->where('category_translations.name', $value)
                            ->where('categories.parent_id', $this->parent_id)
                            ->when($id, function ($query) use ($id) {
                                return $query->where('category_translations.category_id', '!=', $id);
                            })
                            ->exists();

                        if ($exists) {
                            $fail(__('dashboard.unique_exists'));
                        }
                 }
            ],
            'status'=>['required',Rule::in(array_column(Status::cases(), 'value'))],
            'description.ar'=>['nullable',
            'string',
            'regex:/^[\x{0600}-\x{06FF}0-9\x{0660}-\x{0669}\s]+$/u',
            'max:255'],

            'description.en'=>['nullable','string',
            'regex:/^[a-zA-Z0-9\s\-]+$/',
            'max:255'],

            'meta_title.ar'=>['nullable','string','max:255'],
            'meta_title.en'=>['nullable','string','max:255'],
            'meta_description.ar'=>['nullable','string'],
            'meta_description.en'=>['nullable','string'],
            'cover'=>[$id ? 'nullable' : 'required','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ];
    }
}
