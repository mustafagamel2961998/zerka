<?php

namespace App\Http\Controllers\Web\Dashboard\V1\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Contracts\User\UserRepositoryInterface;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Dashboard\V1\User\UpdateRequest;
class UserController extends Controller
{
    public function __construct(private UserRepositoryInterface $user_repository_interface){}
    public function managers(){
        $users = $this->user_repository_interface->managers();
        return view('dashboard.user.manager',compact('users'));
    }
    public function customers()
    {
        $users = $this->user_repository_interface->customers();
        return view('dashboard.user.customer',compact('users'));
    }

    public function edit(User $user){
        $user = $this->user_repository_interface->findById($user);
        $permissions = Permission::all();
        return view('dashboard.user.edit',compact('user','permissions'));
    }

   public function update(UpdateRequest $request, User $user)
    {
        // 1. جلب المستخدم عن طريق الـ Repository المتوفرة لديك
        $user = $this->user_repository_interface->findById($user);

        // 2. فصل البيانات الممررة والآمنة بعد الـ Validation
        $validatedData = $request->validated();

        // 3. تحديث بيانات جدول الـ users الأساسية
        $user->update([
            'email'  => $validatedData['email'],
            'phone'  => $validatedData['phone'] ?? $user->phone,
            'role'   => $validatedData['role'],
            'status' => $validatedData['status'],
        ]);

        // 4. تحديث بيانات الـ profile المرتبط به (باستخدام علاقة الـ HasOne المجهزة لديك)
        $user->profile()->update([
            'first_name' => $validatedData['first_name'],
            'last_name'  => $validatedData['last_name'],
            // يمكنك إضافة أي حقول أخرى للبروفايل هنا مثل الـ country_id إذا أردت
        ]);

        // 5. إدارة الصلاحيات (Permissions) بناءً على الـ Role المختار
        if ($validatedData['role'] === 'admin' && $request->has('permissions')) {
            // مزامنة الصلاحيات المختارة وإلغاء ما سواها
            $user->syncPermissions($validatedData['permissions']);
        } else {
            // إذا تحول إلى customer أو لم يتم اختيار صلاحيات، يتم سحب كافة الصلاحيات منه للأمان
            $user->syncPermissions([]);
        }

        return redirect()->back()->with('success', __('crud.updated'));
    }
}
