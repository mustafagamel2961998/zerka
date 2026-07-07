<?php

namespace App\DTOs\Front\V1\Address;

use App\Http\Requests\Front\V1\Address\AddressRequest;
class UpdateDTO
{

    public function __construct(
       public int $userId, 
       public int $countryId,
       public int $cityId,
       public string $name,
       public string $phone,
       public string $street_details,
       public int $id,
    ) {
        //
    }

    /**
     * Create a DTO instance from a Form Request
     */
    public static function fromRequest(AddressRequest $request): self
    {
        return new self(
            userId:auth()->user()->id,
            countryId:$request->validated('country_id'),
            cityId:$request->validated('city_id'),
            name:$request->validated('name'),
            phone:$request->validated('phone'),
            street_details:$request->validated('street_details'),
            id:request()->route('address'),
        );
    }

    /**
     * Convert the DTO to an array for the Repository/Model
     */
    public function toArray(): array
    {
        return [
            'user_id'=>$this->userId,
            'country_id'=>$this->countryId,
            'city_id'=>$this->cityId,
            'name'=>$this->name,
            'phone'=>$this->phone,
            'street_details'=>$this->street_details,
            'id'=>$this->id
        ];
    }
}