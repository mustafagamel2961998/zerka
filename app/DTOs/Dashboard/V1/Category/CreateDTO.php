<?php

namespace App\DTOs\Dashboard\V1\Category;

use App\Enums\Status;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\Dashboard\V1\Category\CategoryRequest;
class CreateDTO
{
    public function __construct(
        public UploadedFile $cover,
        public string $name_ar,
        public string $name_en,
        public ?string $description_ar,
        public ?string $description_en,
        public ?int $parent_id,
        public Status $status,
        public ?string $meta_title_ar,
        public ?string $meta_title_en,
        public ?string $meta_description_ar,
        public ?string $meta_description_en,
    ) {
        //
    }

    /**
     * Create a DTO instance from a Form Request
     */
    public static function fromRequest(CategoryRequest $request): self
    {
        return new self(
           cover:$request->file('cover'),
           name_ar:$request->validated('name.ar'),
           name_en:$request->validated('name.en'),
           description_ar:$request->validated('description.ar'),
           description_en:$request->validated('description.en'),
           parent_id:$request->validated('parent_id') ? (int) $request->validated('parent_id') : null,
           status:Status::from($request->validated('status')),
           meta_title_ar:$request->validated('meta_title.ar'),
           meta_title_en:$request->validated('meta_title.en'),
           meta_description_ar:$request->validated('meta_description.ar'),
           meta_description_en:$request->validated('meta_description.en'),
         
        );
    }

    /**
     * Convert the DTO to an array for the Repository/Model
     */
    public function toArray(): array
    {
        return [
            'cover' => $this->cover,
            'name' => [
                'ar' => $this->name_ar,
                'en' => $this->name_en,
            ],
            'description' => [
                'ar' => $this->description_ar,
                'en' => $this->description_en,
            ],
            'parent_id' => $this->parent_id,
            'status' => $this->status->value,
            'meta_title' => [
                'ar' => $this->meta_title_ar,
                'en' => $this->meta_title_en,
            ],
            'meta_description' => [
                'ar' => $this->meta_description_ar,
                'en' => $this->meta_description_en,
            ],
            'slug'=>Str::slug($this->name_en),
        ];
    }
}