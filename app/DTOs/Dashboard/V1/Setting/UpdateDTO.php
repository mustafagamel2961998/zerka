<?php

namespace App\DTOs\Dashboard\V1\Setting;

use App\Http\Requests\Dashboard\V1\Setting\SettingRequest;
use Illuminate\Http\UploadedFile;

class UpdateDTO
{
    
    public function __construct(
       public UploadedFile $logo,
       public int $currency_id,
       public int $country_id,
       public string $name_ar,
       public string $name_en,
       public string $email,
       public string $phone,
       public int $tax_percentage,
       public float $shipping_amount,
       public int $id,
       
    ) {
        //
    }

    /**
     * Create a DTO instance from a Form Request
     */
    public static function fromRequest(SettingRequest $request): self
    {
        return new self(
            logo:$request->file('logo'),
            currency_id:$request->validated('currency_id'),
            country_id:$request->validated('country_id'),
            name_ar:$request->validated('name.ar'),
            name_en:$request->validated('name.en'),
            email:$request->validated('email'),
            phone:$request->validated('phone'),
            tax_percentage:$request->validated('tax_percentage'),
            shipping_amount:$request->validated('shipping_amount'),
            id:$request->route('setting')
        );
    }

    /**
     * Convert the DTO to an array for the Repository/Model
     */
    public function toArray(): array
    {
        return [
            'logo'=>$this->logo,
            'currency_id'=>$this->currency_id,
            'country_id'=>$this->country_id,
            'name'      => [
                                'ar' => $this->name_ar,
                                'en' => $this->name_en,
                           ],
            'email'=>$this->email,
            'phone'=>$this->phone,
            'tax_percentage'=>$this->tax_percentage,
            'shipping_amount'=>$this->shipping_amount,
            'id'=>$this->id,
        ];
    }
}