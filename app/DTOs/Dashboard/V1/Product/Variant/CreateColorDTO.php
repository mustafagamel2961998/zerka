<?php

namespace App\DTOs\Dashboard\V1\Product\Variant;

use Illuminate\Foundation\Http\FormRequest;

class CreateColorDTO
{
     public function __construct(
        public int $colorId,
        public int $warehouseId,
        public int $quantity,
        public int $minimumQuantity
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            colorId: (int) $data['color_id'],
            warehouseId: (int) $data['warehouse_id'],
            quantity: (int) $data['quantity'],
            minimumQuantity: (int) $data['minimum_quantity']
        );
    }

    public function toArray(): array
    {
        return [
            'color_id'         => $this->colorId,
            'warehouse_id'     => $this->warehouseId,
            'quantity'         => $this->quantity,
            'minimum_quantity' => $this->minimumQuantity,
        ];
    }
}