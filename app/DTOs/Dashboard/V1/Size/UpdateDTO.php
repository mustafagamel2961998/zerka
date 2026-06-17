<?php

namespace App\DTOs\Dashboard\V1\Size;

use App\Enums\Status;
use App\Http\Requests\Dashboard\V1\Size\SizeRequest;
class UpdateDTO
{
    public function __construct(
         public string $size,
         public Status $status,
         public int $id
    ) {
        $this->size = strtoupper($size);
    }

    /**
     * Create a DTO instance from a Form Request
     */
    public static function fromRequest(SizeRequest $request): self
    {
        return new self(
            size:$request->validated('size'),
            status:Status::from($request->validated('status')),
            id:$request->route('size')
        );
    }

    /**
     * Convert the DTO to an array for the Repository/Model
     */
    public function toArray(): array
    {
        return [
            'size'    => $this->size,
            'status'  => $this->status->value,
            'id'      => $this->id
        ];
    }
}