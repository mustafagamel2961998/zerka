<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepository extends Command
{
    protected $signature = 'make:repository {name : The name of the repository}';
    protected $description = 'Create a new Repository class';

    public function handle(): void
    {
        $name = $this->argument('name');

        // تحويل الاسم إلى مسار
        $path = app_path('Repositories/' . str_replace('\\', '/', $name) . '.php');

        // استخراج المجلد من المسار
        $directory = dirname($path);

        // إنشاء المجلدات إذا لم تكن موجودة
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        if (File::exists($path)) {
            $this->error("Repository {$name} already exists!");
            return;
        }

        // استخراج namespace صحيح
        $namespace = 'App\\Repositories';
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

        $this->info("Repository {$name} created successfully at {$path}");
    }
}
