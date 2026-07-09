<?php

namespace App\DTOs\Dashboard\V1\Order;

use App\Http\Requests\Dashboard\V1\Order\UpdateOrderRequest;
use App\Enums\Order\Status;

class UpdateDTO
{
   public function __construct(
        public int $id,
        public Status $status,
     
    ) {
        //
    }

    /**
     * Create a DTO instance from a Form Request
     */
    public static function fromRequest(UpdateOrderRequest $request): self
    {
        return new self(
            id: request()->route('order'),
            status: Status::from($request->validated('status')),

        );
    }

    /**
     * Convert the DTO to an array for the Repository/Model
     */
    public function toArray(): array
    {
        return [
            'id'          => $this->id,
            'status'      => $this->status->value,
        ];
    }
}