<?php

namespace App\Repositories\Contracts\User;
use App\Models\User;

interface UserRepositoryInterface
{
    public function findById(User $user) : User;
    public function update(array $data) : User;
    
}