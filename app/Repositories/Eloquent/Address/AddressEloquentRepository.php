<?php

namespace App\Repositories\Eloquent\Address;
use App\Repositories\Contracts\Address\AddressRepositoryInterface;
use App\Models\Address;
class AddressEloquentRepository implements AddressRepositoryInterface
{
    public function __construct()
    {
        //
    }
    public function store(array $data) : Address
    {
        return Address::create($data);
    }
    public function findById($id) : Address
    {
        return Address::find($id);
    }
    public function update(array $data) : Address
    {
        $address = $this->findById($data['id']);
        $address->update($data);
        return $address;
    }
    
    public function destroy($id) : bool
    {
        $address = $this->findById($data['id']);
        return $address->delete();

    }
}