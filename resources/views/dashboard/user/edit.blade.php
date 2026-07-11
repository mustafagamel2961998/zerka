@php
    use App\Enums\Status;
@endphp
<x-dashboard.layout title="{{ __('dashboard.edit_user')}}">
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard/pages/user/user.css') }}">
        <style>
            .form-control:focus, .form-select:focus {
                border-color: #000;
                box-shadow: none;
            }
            .permission-card {
                transition: all 0.2s ease;
                border: 1px solid #e5e7eb;
            }
            .permission-card:hover {
                border-color: #000;
                background-color: #fafafa;
            }
            .btn-black {
                background-color: #000;
                color: #fff;
                border-radius: 4px;
            }
            .btn-black:hover {
                background-color: #222;
                color: #fff;
            }
        </style>
    @endpush

    <div class="row">
        <div class="col-xl-12">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <!-- رأس الكارت -->
                <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold text-dark m-0 d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:user-speak-rounded-bold-duotone" class="text-primary fs-22"></iconify-icon>
                        <span>{{ __('dashboard.edit_user_details') ?? 'تعديل بيانات المستخدم' }}: <span class="text-muted small fw-normal">{{ $user->profile?->full_name ?? $user->email }}</span></span>
                    </h5>
                   
                </div>

                <!-- جسم الكارت / الفورم -->
                <div class="card-body p-4">
                    <form action="{{ route('dashboard.v1.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')

                        <!-- القسم الأول: البيانات الشخصية والملف الشخصي -->
                        <h6 class="fw-bold text-uppercase tracking-wider text-secondary mb-3 fs-13" style="letter-spacing: 0.5px;">
                            {{ __('dashboard.personal_information') ?? 'البيانات الشخصية' }}
                        </h6>
                        
                        <div class="row g-3 mb-4">
                            <!-- الاسم الأول -->
                            <div class="col-md-6">
                                <label for="first_name" class="form-label fw-semibold text-dark small">{{ __('global.first_name') ?? 'الاسم الأول' }}</label>
                                <input type="text" name="first_name" id="first_name" 
                                    class="form-control rounded-2 @error('first_name') is-invalid @enderror" 
                                    value="{{ old('first_name', $user->profile?->first_name) }}" required>
                                @error('first_name')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <!-- الاسم الأخير -->
                            <div class="col-md-6">
                                <label for="last_name" class="form-label fw-semibold text-dark small">{{ __('global.last_name') ?? 'الاسم الأخير' }}</label>
                                <input type="text" name="last_name" id="last_name" 
                                    class="form-control rounded-2 @error('last_name') is-invalid @enderror" 
                                    value="{{ old('last_name', $user->profile?->last_name) }}" required>
                                @error('last_name')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <!-- البريد الإلكتروني -->
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold text-dark small">{{ __('global.email') }}</label>
                                <input type="email" name="email" id="email" 
                                    class="form-control rounded-2 @error('email') is-invalid @enderror" 
                                    value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <!-- رقم الهاتف -->
                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-semibold text-dark small">{{ __('global.phone') }}</label>
                                <input type="tel" name="phone" id="phone" 
                                    class="form-control rounded-2 @error('phone') is-invalid @enderror" 
                                    value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <hr class="text-muted opacity-25 my-4">

                        <!-- القسم الثاني: الصلاحيات والأدوار (Roles & Status) -->
                        <h6 class="fw-bold text-uppercase tracking-wider text-secondary mb-3 fs-13" style="letter-spacing: 0.5px;">
                            {{ __('dashboard.roles_and_status') ?? 'الأدوار والحالة الإدارية' }}
                        </h6>

                        <div class="row g-3 mb-4">
                            <!-- اختيار الـ Role (Admin or Customer) -->
                            <div class="col-md-6">
                                <label for="role" class="form-label fw-semibold text-dark small">{{ __('global.role') ?? 'الدور الإداري (Role)' }}</label>
                                <select name="role" id="role" class="form-select rounded-2 @error('role') is-invalid @enderror" required>
                                    <option value="customer" @selected(old('role', $user->role) === 'customer')>{{ __('global.customer') ?? 'Customer (عميل)' }}</option>
                                    <option value="admin" @selected(old('role', $user->role) === 'admin')>{{ __('global.admin') ?? 'Admin (مدير)' }}</option>
                                </select>
                                @error('role')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <!-- حالة الحساب (Status) -->
                          <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <label for="status"
                                        class="form-label required d-block mb-2">{{ __('form.status') }}</label>
                                    <input class="form-check-input ms-0" type="checkbox" id="status" name="status"
                                        role="switch" @checked(old('status', $user->status?->value) === Status::ACTIVE->value)>
                                    @error('status')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        </div>

                        <hr class="text-muted opacity-25 my-4">

                        <!-- القسم الثالث: الصلاحيات التفصيلية (Permissions) -->
                        <div id="permissions-section" class="{{ old('role', $user->role) === 'customer' ? 'd-none' : '' }}">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="fw-bold text-uppercase tracking-wider text-secondary m-0 fs-13" style="letter-spacing: 0.5px;">
                                    {{ __('dashboard.permissions') ?? 'الصلاحيات التفصيلية (Permissions)' }}
                                </h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="select-all-permissions">
                                    <label class="form-check-label small text-muted user-select-none" for="select-all-permissions">
                                        {{ __('global.select_all') ?? 'تحديد الكل' }}
                                    </label>
                                </div>
                            </div>

                            <!-- شبكة توزيع الصلاحيات -->
                            <div class="row g-3 mb-4">
                                @foreach($permissions as $permission)
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="card permission-card rounded-2 p-3 h-100 mb-0">
                                            <div class="form-check mb-0">
                                                <input class="form-check-input permission-checkbox" type="checkbox" 
                                                    name="permissions[]" 
                                                    value="{{ $permission->name }}" 
                                                    id="perm-{{ $permission->id }}"
                                                    @checked(in_array($permission->name, old('permissions', $user->permissions->pluck('name')->toArray() ?? [])))>
                                                <label class="form-check-label fw-medium text-dark small d-block cursor-pointer user-select-none" for="perm-{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <hr class="text-muted opacity-25 my-4">
                        </div>

                        <!-- أزرار الحفظ -->
                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-black px-4">
                                <iconify-icon icon="solar:diskette-broken" class="align-middle me-1"></iconify-icon>
                                {{ __('global.save_changes')}}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('javascript')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const roleSelect = document.getElementById('role');
                const permissionsSection = document.getElementById('permissions-section');
                const selectAllCheckbox = document.getElementById('select-all-permissions');
                const checkboxes = document.querySelectorAll('.permission-checkbox');

                // إظهار/إخفاء قسم الصلاحيات بناءً على الـ Role المختار ديناميكياً
                roleSelect.addEventListener('change', function () {
                    if (this.value === 'admin') {
                        permissionsSection.classList.remove('d-none');
                    } else {
                        permissionsSection.classList.add('d-none');
                        // إلغاء تحديد التشييكات إذا تحول لعميل لتجنب إرسال داتا خطأ
                        checkboxes.forEach(cb => cb.checked = false);
                        selectAllCheckbox.checked = false;
                    }
                });

                // سكريبت "تحديد الكل" الخاص بالـ Permissions
                if (selectAllCheckbox) {
                    selectAllCheckbox.addEventListener('change', function () {
                        checkboxes.forEach(cb => cb.checked = this.checked);
                    });
                }
            });
        </script>
    @endpush
</x-dashboard.layout>