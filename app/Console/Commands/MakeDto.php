<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeDto extends Command
{
    // غيرنا اسم الأمر والوصف لـ dto
    protected $signature = 'make:dto {name : The name of the DTO}';
    protected $description = 'Create a new DTO (Data Transfer Object) class';

    public function handle(): void
    {
        $name = $this->argument('name');

        // تحويل الاسم إلى مسار جوه مجلد DTOs
        $path = app_path('DTOs/' . str_replace('\\', '/', $name) . '.php');

        // استخراج المجلد من المسار
        $directory = dirname($path);

        // إنشاء المجلدات إذا لم تكن موجودة
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        if (File::exists($path)) {
            $this->error("DTO {$name} already exists!");
            return;
        }

        // استخراج namespace صحيح لـ App\DTOs
        $namespace = 'App\\DTOs';
        // استبدال الباك سلاش بسلاش لتوحيد المعالجة
        $name = str_replace('\\', '/', $name);
        $nameParts = explode('/', $name);
        
        if (count($nameParts) > 1) {
            $namespace .= '\\' . implode('\\', array_slice($nameParts, 0, -1));
        }

        $className = end($nameParts);

        // قالب الـ DTO الاحترافي مع الهيكل الأساسي
        $stub = <<<PHP
<?php

namespace {$namespace};

use Illuminate\Foundation\Http\FormRequest;

class {$className}
{
    public function __construct(
        // public string \$property
    ) {
        //
    }

    /**
     * Create a DTO instance from a Form Request
     */
    public static function fromRequest(FormRequest \$request): self
    {
        return new self(
            // \$request->validated('property')
        );
    }

    /**
     * Convert the DTO to an array for the Repository/Model
     */
    public function toArray(): array
    {
        return [
            // 'property' => \$this->property,
        ];
    }
}
PHP;

        File::put($path, $stub);

        $this->info("DTO {$name} created successfully at {$path}");
    }
}