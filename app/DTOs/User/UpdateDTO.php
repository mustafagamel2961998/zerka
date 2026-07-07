<?php

namespace App\DTOs\User;

use App\Http\Requests\User\UserRequest;
class UpdateDTO
{
    
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $email,
        public ?string $current_password,
        public ?string $new_password
    ) {
        //
    }

    /**
     * Create a DTO instance from a Form Request
     */
    public static function fromRequest(UserRequest $request): self
    {
        return new self(
            first_name:$request->validated('first_name'),
            last_name:$request->validated('last_name'),
            email:$request->validated('email'),
            current_password:$request->validated('current_password'),
            new_password:$request->validated('new_password'),
        );
    }

    /**
     * Convert the DTO to an array for the Repository/Model
     */
    public function toArray(): array
    {
        return [
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'email'=>$this->email,
            'current_password'=>$this->current_password,
            'new_password'=>$this->new_password
        ];
    }
}