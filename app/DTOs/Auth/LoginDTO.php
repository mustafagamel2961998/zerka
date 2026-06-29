<?php

namespace App\DTOs\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginDTO
{
    public function __construct(
         public string $login,
         public string $password
    ) {
    }

    /**
     * Create a DTO instance from a Form Request
     */
    public static function fromRequest(FormRequest $request): self
    {
        return new self(
            login:$request->validated('login'),
            password:$request->validated('password'),
        );
    }

    /**
     * Convert the DTO to an array for the Repository/Model
     */
    public function toArray(): array
    {
        return [
           'login'=>$this->login,
           'password'=>$this->password
        ];
    }
}