<?php

namespace App\DTOs\Dashboard\V1\City;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Status;

class UpdadteDTO
{
   public function __construct(
        public int $country_id,
        public Status $status,
        public string $name_ar,
        public string $name_en,
    ) {
        //
    }

    /**
     * Create a DTO instance from a Form Request
     */
    public static function fromRequest(FormRequest $request): self
    {
        return new self(
            country_id: $request->validated('country_id') ? (int) $request->validated('country_id') : null,
            status:      Status::from($request->validated('status')),
            name_ar:     $request->validated('name.ar'),
            name_en:     $request->validated('name.en'),
        );
    }

    /**
     * Convert the DTO to an array for the Repository/Model
     */
    public function toArray(): array
    {
        return [
           
            'country_id'  => $this->country_id,
            'status'      => $this->status->value,
            'name'        => [
                                'ar' => $this->name_ar,
                                'en' => $this->name_en,
                            ],           
        ];
    }
}