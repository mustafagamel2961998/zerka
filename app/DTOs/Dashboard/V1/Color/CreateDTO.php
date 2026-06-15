<?php

namespace App\DTOs\Dashboard\V1\Color;

use App\Enums\Status;
use App\Http\Requests\Dashboard\V1\Color\ColorRequest;
class CreateDTO
{
    public function __construct(
         public string $code,
         public Status $status
    ) {
        //
    }

    /**
     * Create a DTO instance from a Form Request
     */
    public static function fromRequest(ColorRequest $request): self
    {
        return new self(
            code:$request->validated('code'),
            status:Status::from($request->validated('status')),
        );
    }

    /**
     * Convert the DTO to an array for the Repository/Model
     */
    public function toArray(): array
    {
        return [
            'code'    => $this->code,
            'status'  => $this->status->value
        ];
    }
}