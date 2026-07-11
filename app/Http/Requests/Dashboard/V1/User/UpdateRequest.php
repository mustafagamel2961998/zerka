<?php

namespace App\Http\Requests\Dashboard\V1\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateRequest extends FormRequest
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
        // جلب الـ ID الخاص بالمستخدم من الرابط لتخطي التحقق من الإيميل الفريد له
        $userId = $this->route('user') ?? $this->route('id');

        return [
            // بيانات جدول الـ profiles
            'first_name'    => ['required', 'string', 'max:100'],
            'last_name'     => ['required', 'string', 'max:100'],
            
            // بيانات جدول الـ users
            'email'         => ['required', 'email', 'max:150', Rule::unique('users', 'email')->ignore($userId)],
            'phone'         => ['nullable', 'string', 'max:20'],
            'role'          => ['required', 'string', Rule::in(['admin', 'customer'])],
            'status'        => ['required', 'string', Rule::in(['active', 'inactive'])],
            
            // الصلاحيات (مطلوبة فقط إذا كان المختار admin)
            'permissions'   => ['nullable', 'array'],
            'permissions.*' => ['string', Rule::exists('permissions', 'name')],
        ];
    }
}
