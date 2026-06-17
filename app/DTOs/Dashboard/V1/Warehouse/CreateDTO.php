<?php

namespace App\DTOs\Dashboard\V1\Warehouse;

use App\Enums\Status;
use App\Http\Requests\Dashboard\V1\Warehouse\WarehouseRequest;
class CreateDTO
{
    

    public function __construct(
       public int $country_id, 
       public int $city_id, 
       public string $name_ar,
       public string $name_en,
       public ?string $description_ar,
       public ?string $description_en,
       public string $phone,
       public ?string $street_details,
       public Status $status
    ) {
        //
    }

    /**
     * Create a DTO instance from a Form Request
     */
    public static function fromRequest(WarehouseRequest $request): self
    {
        return new self(
            country_id:$request->validated('country_id'),
            city_id:$request->validated('city_id'),
            name_ar:$request->validated('name.ar'),
            name_en:$request->validated('name.en'),
            description_ar:$request->validated('description.ar'),
            description_en:$request->validated('description.en'),
            phone:$request->validated('phone'),
            street_details:$request->validated('street_details'),
            status:Status::from($request->validated('status')),
        );
    }

    /**
     * Convert the DTO to an array for the Repository/Model
     */
    public function toArray(): array
    {
        return [
            'country_id'=>$this->country_id,
            'city_id'=>$this->city_id,
            'name'=>[
                'ar'=>$this->name_ar,
                'en'=>$this->name_en
            ],
            'description'=>[
                'ar'=>$this->description_ar,
                'en'=>$this->description_en
            ],
            'phone'=>$this->phone,
            'street_details'=>$this->street_details,
            'status'=>$this->status->value
        ];
    }
}