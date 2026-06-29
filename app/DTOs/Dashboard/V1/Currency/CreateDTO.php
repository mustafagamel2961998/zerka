<?php

namespace App\DTOs\Dashboard\V1\Currency;

use App\Http\Requests\Dashboard\V1\Currency\CurrencyRequest;
use App\Enums\Status;
class CreateDTO
{
    public function __construct(
        public string $code,
        public float $exchange_rate,
        public int $decimal_places,
        public Status $status,
        public string $name_ar,
        public string $name_en,
        public string $symbol_ar,
        public string $symbol_en
    ) {
        $this->code = strtoupper($code);
        $this->symbol_en = strtoupper($symbol_en);
    }

    /**
     * Create a DTO instance from a Form Request
     */
    public static function fromRequest(CurrencyRequest $request): self
    {
        return new self(
            code:$request->validated('code'),
            exchange_rate:$request->validated('exchange_rate'),
            decimal_places:$request->validated('decimal_places'),
            status:Status::from($request->validated('status')),
            name_ar:$request->validated('name.ar'),
            name_en:$request->validated('name.en'),
            symbol_ar:$request->validated('symbol.ar'),
            symbol_en:$request->validated('symbol.en'),
        );
    }

    /**
     * Convert the DTO to an array for the Repository/Model
     */
    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'exchange_rate' => $this->exchange_rate,
            'decimal_places' => $this->decimal_places,
            'status' => $this->status->value,
            'name' => [
                'ar' => $this->name_ar,
                'en' => $this->name_en,
            ],
            'symbol' => [
                'ar' => $this->symbol_ar,
                'en' => $this->symbol_en,
            ],
        ];
    }
}