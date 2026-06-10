<?php

namespace App\Repositories\Contracts\Auth;

interface AuthRepositoryInterface
{
    public function login(array $data) : object;
    
}