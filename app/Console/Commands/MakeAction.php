<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeAction extends Command
{
    protected $signature = 'make:action {name : The name of the action}';
    protected $description = 'Create a new Action class';

    public function handle(): void
    {
        $name = $this->argument('name');

        // تحويل الاسم إلى مسار
        $path = app_path('Actions/' . str_replace('\\', '/', $name) . '.php');

        // استخراج المجلد من المسار
        $directory = dirname($path);

        // إنشاء المجلدات إذا لم تكن موجودة
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        if (File::exists($path)) {
            $this->error("Action {$name} already exists!");
            return;
        }

        // استخراج namespace صحيح
        $namespace = 'App\\Actions';
        $nameParts = explode('/', $name);
        if (count($nameParts) > 1) {
            $namespace .= '\\' . implode('\\', array_slice($nameParts, 0, -1));
        }

        $className = end($nameParts);

        $stub = <<<PHP
<?php

namespace {$namespace};

class {$className}
{
    public function __construct()
    {
        //
    }
}
PHP;

        File::put($path, $stub);

        $this->info("Action {$name} created successfully at {$path}");
    }
}
