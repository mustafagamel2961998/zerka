<?php

namespace App\Actions\User;
use App\Repositories\Contracts\User\UserRepositoryInterface;
use App\DTOs\User\UpdateDTO;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class UpdateAction
{
    public function __construct(private UserRepositoryInterface $user_repository_interface){}

    public function execute(UpdateDTO $update_dto)
    {
        $user  = $this->user_repository_interface->findById(auth()->user());
        if(!Hash::check($update_dto->current_password, $user->password)){
            throw ValidationException::withMessages([
                    'error' => [__('global.wrong_password')], 
            ]);
        }
    
        return $this->user_repository_interface->update($update_dto->toArray());
    }
}