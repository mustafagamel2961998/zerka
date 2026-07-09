<?php

namespace App\DTOs\Front\V1\Checkout;

use Illuminate\Http\UploadedFile;
use App\Http\Requests\Front\V1\Checkout\CheckoutRequest;
class CreateDTO
{
    public function __construct(
        public ?UploadedFile $screen_shot,
        public int $address_id,
        public string $payment_method,
    ) {
        $this->user_id = auth()->user()->id;
    }

    /**
     * Create a DTO instance from a Form Request
     */
    public static function fromRequest(CheckoutRequest $request): self
    {
        return new self(
            address_id: $request->validated('address_id'),
            payment_method: $request->validated('payment_method'),
            screen_shot: $request->file('screen_shot'),
        );
    }

    /**
     * Convert the DTO to an array for the Repository/Model
     */
    public function toArray(): array
    {
        return [
            'address_id' => $this->address_id,
            'payment_method' => $this->payment_method,
            'screen_shot' => $this->screen_shot,
        ];
    }
}