<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\DTOs\Auth\RegisterDTO;
use App\Repositories\Contracts\Auth\AuthRepositoryInterface;
use Illuminate\Validation\ValidationException;
class RegisterAction
{
    public function __construct(protected AuthRepositoryInterface $auth_repository_interface){}
    public function execute(RegisterDTO $data){
        
        $user = $this->auth_repository_interface->register($data->toArray());
        Auth::login($user, true);
        request()->session()->regenerate();
    }
}