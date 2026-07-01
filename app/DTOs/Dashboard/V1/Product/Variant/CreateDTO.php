<?php

namespace App\DTOs\Dashboard\V1\Product\Variant;

use Illuminate\Foundation\Http\FormRequest;

class CreateDTO
{
    public function __construct(
        public int $sizeId,
        public array $colors,
        public int $warehouseId,
        public float $price,
        public int $quantity,
        public int $minimumQuantity
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            sizeId: (int) $data['size_id'],
            colors:  $data['colors'],
            warehouseId: (int) $data['warehouse_id'],
            price: (float) $data['price'],
            quantity: (int) $data['quantity'],
            minimumQuantity: (int) $data['minimum_quantity']
        );
    }

    public function toArray(): array
    {
        return [
            'size_id'          => $this->sizeId,
            'colors'           => $this->colors,
            'warehouse_id'     => $this->warehouseId,
            'price'            => $this->price,
            'quantity'         => $this->quantity,
            'minimum_quantity' => $this->minimumQuantity,
        ];
    }
}