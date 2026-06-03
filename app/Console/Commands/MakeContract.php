<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeContract extends Command
{
    // تغيير الوصف هنا ليكون معبر أكتر
    protected $signature = 'make:contract {name : The name of the contract interface}';
    protected $description = 'Create a new Repository Contract (Interface)';

    public function handle(): void
    {
        $name = $this->argument('name');

        // توحيد السلاش ليكون متوافق مع نظام التشغيل
        $name = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $name);

        // تحديد المسار الكامل للملف في App/Repositories/Contracts
        $path = app_path('Repositories' . DIRECTORY_SEPARATOR . 'Contracts' . DIRECTORY_SEPARATOR . $name . '.php');

        // استخراج المجلد والـ Class Name
        $directory = dirname($path);

        // إنشاء المجلدات لو مش موجودة
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        // التأكد إن الملف مش موجود قبل كده
        if (File::exists($path)) {
            $this->error("Contract {$name} already exists!");
            return;
        }

        // حساب الـ Namespace الديناميكي بناءً على مكان المجلد
        $className = basename($path, '.php');
        $relativeFolder = str_replace(app_path('Repositories' . DIRECTORY_SEPARATOR . 'Contracts'), '', $directory);
        
        $namespace = 'App\\Repositories\\Contracts';
        if (!empty($relativeFolder)) {
            // تحويل مسار المجلد الفرعي لـ Namespace مع تنظيف السلاش المكرر
            $namespace .= str_replace(DIRECTORY_SEPARATOR, '\\', $relativeFolder);
        }

        // الـ Stub الخاص بالـ Interface (تغيير كلمة class لـ interface وفاضي من جوه)
        $stub = <<<PHP
<?php

namespace {$namespace};

interface {$className}
{
    // Define your repository methods here
}
PHP;

        // كتابة الملف
        File::put($path, $stub);

        // تعديل رسالة النجاح عشان تطبع الاسم والمسار صح
        $this->info("Contract [{$name}] created successfully.");
    }
}