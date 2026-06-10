<?php

namespace App\Repositories\Eloquent\Auth;
use App\Repositories\Contracts\Auth\AuthRepositoryInterface;
use App\Models\User;
class AuthEloquentRepository implements AuthRepositoryInterface
{
    public function __construct()
    {
        //
    }
    public function login(array $data) : object
    {
        return User::where('email', $data['login'])
                        ->orWhere('phone',$data['login'])->sole();
    }
}