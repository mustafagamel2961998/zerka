<?php

namespace App\DTOs\Dashboard\V1\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDTO
{
    public function __construct(
        // public string $property
    ) {
        //
    }

    /**
     * Create a DTO instance from a Form Request
     */
    public static function fromRequest(FormRequest $request): self
    {
        return new self(
            // $request->validated('property')
        );
    }

    /**
     * Convert the DTO to an array for the Repository/Model
     */
    public function toArray(): array
    {
        return [
            // 'property' => $this->property,
        ];
    }
}