<?php

namespace App\Repositories\Contracts\Currency;

use App\Models\Currency;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
interface CurrencyRepositoryInterface
{
    public function index() : Collection;
    public function getPaginated($perPage = null) : LengthAwarePaginator;
    public function findById($id) : Currency;
    public function store(array $data) : Currency;
    // public function update(array $data) : Currency;
    public function destroy($id) : bool;

}