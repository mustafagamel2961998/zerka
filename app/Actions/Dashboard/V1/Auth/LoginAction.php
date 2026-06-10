<?php

namespace App\Actions\Dashboard\V1\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\DTOs\Dashboard\V1\Auth\LoginDTO;
use App\Repositories\Contracts\Auth\AuthRepositoryInterface;
use Illuminate\Validation\ValidationException;
class LoginAction
{
    public function __construct(protected AuthRepositoryInterface $auth_repository_interface){}
    public function execute(LoginDTO $data){
        
        $credentials = $data->toArray();
        $user = $this->auth_repository_interface->login($credentials);
        if(!$user || !Hash::check($credentials['password'], $user->password)){
             throw ValidationException::withMessages([
                'login_failed' => __('dashboard.login_failed')
            ]);
        }

        Auth::login($user, true);
        request()->session()->regenerate();
   
    }
}