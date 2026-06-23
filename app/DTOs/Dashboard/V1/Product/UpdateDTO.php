<?php

namespace App\DTOs\Dashboard\V1\Product;
use App\Enums\Status;
use App\Http\Requests\Dashboard\V1\Product\ProductRequest;
use Illuminate\Support\Str;
use App\DTOs\Dashboard\V1\Product\Variant\CreateDTO;
use Illuminate\Http\UploadedFile;
use InvalidArgumentException;

class UpdateDTO
{
     public function __construct(
        public int $categoryId,
        public string $name_ar,
        public string $name_en,
        public ?string $description_ar,
        public ?string $description_en,
        public ?string $longDescription_ar,
        public ?string $longDescription_en,
        public ?string $metaTitle_ar,
        public ?string $metaTitle_en,
        public ?string $metaDescription_ar,
        public ?string $metaDescription_en,
        public Status $status, 
        public array $variants,
        public ?array $images = [],
        public int $id,
    ) {
        if(isset($this->images)) {
            foreach ($this->images as $image) {
                if (!$image instanceof UploadedFile) {
                    throw new InvalidArgumentException("Every item in images must be an instance of UploadedFile.");
                }
            }
         }
    }

    /**
     * Create a DTO instance from a Form Request
     */
    public static function fromRequest(ProductRequest $request): self
    {
         $variantsDTOs = array_map(function ($variant) {
            return CreateDTO::fromArray($variant);
        }, $request->validated('variants', []));
        return new self(
            categoryId: (int) $request->validated('category_id'),
            name_ar: $request->validated('name.ar'),
            name_en: $request->validated('name.en'),
            description_ar: $request->validated('description.ar'),
            description_en: $request->validated('description.en'),
            longDescription_ar: $request->validated('long_description.ar'),
            longDescription_en: $request->validated('long_description.en'),
            metaTitle_ar: $request->validated('meta_title.ar'),
            metaTitle_en: $request->validated('meta_title.en'),
            metaDescription_ar: $request->validated('meta_description.ar'),
            metaDescription_en: $request->validated('meta_description.en'),
            status: Status::from($request->validated('status')),
            variants: $variantsDTOs,
            images: $request->file('images'),
            id:$request->route('product')
        );
    }

    /**
     * Convert the DTO to an array for the Repository/Model
     */
    public function toArray(): array
    {
        return [
            'category_id' => $this->categoryId,
            'name' => [
                'ar' => $this->name_ar,
                'en' => $this->name_en,
            ],
            'description' => [
                'ar' => $this->description_ar,
                'en' => $this->description_en,
            ],
            'long_description' => [
                'ar' => $this->longDescription_ar,
                'en' => $this->longDescription_en,
            ],
            'meta_title' => [
                'ar' => $this->metaTitle_ar,
                'en' => $this->metaTitle_en,
            ],
            'meta_description' => [
                'ar' => $this->metaDescription_ar,
                'en' => $this->metaDescription_en,
            ],
            
            'variants' => array_map(function (CreateDTO $variant) {
                return $variant->toArray();
            }, $this->variants),

            'status' => $this->status, // أو $this->status->value
            'images' => $this->images,
            'slug'=>Str::slug($this->name_en),
            'id'=>$this->id
        ];
    }
}