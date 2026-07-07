<?php

namespace App\Repositories\Contracts\Address;

use App\Models\Address;

interface AddressRepositoryInterface
{
    public function store(array $data) :Address;
    public function update(array $data) :Address;
    public function findById($id) :Address;
    public function destroy($id) :bool;
}