<?php

namespace App\DTOs\Front\V1\Cart;

use App\Http\Requests\Front\V1\Cart\CartRequest;
class CreateDTO
{
    public function __construct(
        public int $quantity,
        public int $variant_color_id,
        public int $variant_id
    ) {
        //
    }

    /**
     * Create a DTO instance from a Form Request
     */
    public static function fromRequest(CartRequest $request): self
    {
        return new self(
            quantity:$request->validated('quantity'),
            variant_color_id:$request->validated('variant_color_id'),
            variant_id:$request->validated('variant_id'),
        );
    }

    /**
     * Convert the DTO to an array for the Repository/Model
     */
    public function toArray(): array
    {
        return [
            'quantity'=>$this->quantity,
            'variant_color_id'=>$this->variant_color_id,
            'variant_id'=>$this->variant_id
        ];
    }
}