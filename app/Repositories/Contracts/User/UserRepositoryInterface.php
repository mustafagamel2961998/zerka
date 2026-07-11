<?php

namespace App\Repositories\Contracts\User;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
interface UserRepositoryInterface
{
    public function customers() : LengthAwarePaginator;
    public function managers() : LengthAwarePaginator;
    public function findById(User $user) : User;
    public function update(array $data) : User;
    
}