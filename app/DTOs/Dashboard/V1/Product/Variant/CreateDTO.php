<?php

namespace App\DTOs\Dashboard\V1\Product\Variant;

use Illuminate\Foundation\Http\FormRequest;

class CreateDTO
{
    public function __construct(
        public int $sizeId,
        public float $price,
        public array $colors
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            sizeId: (int) $data['size_id'],
            price: (float) $data['price'],
            colors: array_map(
                fn (array $color) => CreateColorDTO::fromArray($color),
                $data['colors']
            )
        );
    }

    public function toArray(): array
    {
        return [
            'size_id' => $this->sizeId,
            'price'   => $this->price,
            'colors'  => array_map(fn (CreateColorDTO $c) => $c->toArray(), $this->colors),
        ];
    }
}