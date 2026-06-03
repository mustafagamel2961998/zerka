<?php

namespace App\Actions\Dashboard\V1\Auth;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginAction
{
    public function execute(array $credentials){
        
        try{
            $user = User::where('email',$credentials['login'])
                                ->orWhere('phone',$credentials['login'])
                                ->first();
            if(!$user || !Hash::check($credentials['password'], $user->password)){
                throw new Exception(__('dashboard.login_failed'));
            }
            Auth::login($user, true);
            request()->session()->regenerate();

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}