<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
    protected $signature = 'make:service {name : The name of the service}';
    protected $description = 'Create a new Service class';

    public function handle(): void
    {
        $name = $this->argument('name');

        // تحويل الاسم إلى مسار
        $path = app_path('Services/' . str_replace('\\', '/', $name) . '.php');

        // استخراج المجلد من المسار
        $directory = dirname($path);

        // إنشاء المجلدات إذا لم تكن موجودة
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        if (File::exists($path)) {
            $this->error("Service {$name} already exists!");
            return;
        }

        // استخراج namespace صحيح
        $namespace = 'App\\Services';
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

        $this->info("Service {$name} created successfully at {$path}");
    }
}
