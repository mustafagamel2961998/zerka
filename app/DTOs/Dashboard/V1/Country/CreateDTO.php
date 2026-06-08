<?php

namespace App\DTOs\Dashboard\V1\Country;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Status;
class CreateDTO
{
    public function __construct(
        public string $iso2,
        public string $iso3,
        public Status $status,
        public string $name_ar,
        public string $name_en,

        public ?int $currency_id = null,
        public ?string $phone_code = null,
        public ?string $timezone = null,
    ) {
        $this->iso2 = strtoupper($iso2);
        $this->iso3 = strtoupper($iso3);
    }

    /**
     * Create a DTO instance from a Form Request
     */
    public static function fromRequest(FormRequest $request): self
    {
        return new self(
            iso2:        $request->validated('iso2'),
            iso3:        $request->validated('iso3'),
            status:      Status::from($request->validated('status')),
            name_ar:     $request->validated('name.ar'),
            name_en:     $request->validated('name.en'),

            currency_id: $request->validated('currency_id') ? (int) $request->validated('currency_id') : null,
            phone_code:  $request->validated('phone_code'),
            timezone:    $request->validated('timezone'),
        );
    }

    /**
     * Convert the DTO to an array for the Repository/Model
     */
    public function toArray(): array
    {
        return [
            'iso2'        => $this->iso2,
            'iso3'        => $this->iso3,
            'status'      => $this->status->value,
            'name'        => [
                                'ar' => $this->name_ar,
                                'en' => $this->name_en,
                            ],
                
            'currency_id' => $this->currency_id,
            'phone_code'  => $this->phone_code,
            'timezone'    => $this->timezone,
        ];
    }
}