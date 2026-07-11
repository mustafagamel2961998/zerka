<?php

namespace App\Repositories\Eloquent\User;
use App\Repositories\Contracts\User\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;

class UserEloquentRepository implements UserRepositoryInterface
{

    public function managers($perPage = null) : LengthAwarePaginator
    {
        return User::where('role','admin')->with([
            'country.currentTranslation:id,country_id,name',
            'profile',
            'profile.city.currentTranslation:id,city_id,name',
            'addresses'=>fn($q)=>$q->with(['country.currentTranslation:id,country_id,name','city.currentTranslation:id,city_id,name']),
            'orders'
        ])->paginate($perPage ?? 20);
    } 

    public function customers($perPage = null) : LengthAwarePaginator
    {
        return User::where('role','customer')->with([
            'country.currentTranslation:id,country_id,name',
            'profile',
            'profile.city.currentTranslation:id,city_id,name',
            'addresses'=>fn($q)=>$q->with(['country.currentTranslation:id,country_id,name','city.currentTranslation:id,city_id,name']),
            'orders'
        ])->paginate($perPage ?? 20);
    }

    public function findById(User $user) : User
    {
        $user = User::with([
            'profile',
            'addresses'=>fn($q)=>$q->with(['country.currentTranslation:id,country_id,name','city.currentTranslation:id,city_id,name']),
            'orders'
        ])->find($user->id);
        return $user;
    }

    public function update(array $data) : User
    {
     $user = $this->findById(auth()->user());
     $updateData = [
        'email' => $data['email'],
    ];

    if (!empty($data['new_password'])) {
        $updateData['password'] = Hash::make($data['new_password']);
    }
     $user->update($updateData);
     $user->profile->update([
       'first_name'=>$data['first_name'],
       'last_name'=>$data['last_name'],
     ]);
     return $user;
    }
}