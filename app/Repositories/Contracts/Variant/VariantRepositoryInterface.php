<?php

namespace App\Repositories\Contracts\Variant;
use Illuminate\Support\Collection;
use App\Models\Product;
interface VariantRepositoryInterface
{
    public function store(array $data,Product $product);

}