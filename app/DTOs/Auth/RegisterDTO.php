<?php

namespace App\DTOs\Auth;

use App\Http\Requests\Auth\RegisterRequest;
class RegisterDTO
{
    public function __construct(
         public int $country_id,
         public int $city_id,
         public string $first_name,
         public string $last_name,
         public string $email,
         public string $phone,
         public string $password,
    ) {
    }

    /**
     * Create a DTO instance from a Form Request
     */
    public static function fromRequest(RegisterRequest $request): self
    {
        return new self(
          country_id:$request->validated('country_id'),
          city_id:$request->validated('city_id'),
          first_name:$request->validated('first_name'),
          last_name:$request->validated('last_name'),
          email:$request->validated('email'),
          phone:$request->validated('phone'),
          password:$request->validated('password'),
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
          'first_name'=>$this->first_name,
          'last_name'=>$this->last_name,
          'email'=>$this->email,
          'phone'=>$this->phone,
          'password'=>$this->password
        ];
    }
}