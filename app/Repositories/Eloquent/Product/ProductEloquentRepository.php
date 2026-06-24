<?php

namespace App\Repositories\Eloquent\Product;
use App\Repositories\Contracts\Product\ProductRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Product;
use App\Repositories\Contracts\Variant\VariantRepositoryInterface;
use Illuminate\Support\Collection;
class ProductEloquentRepository implements ProductRepositoryInterface
{
    public function __construct(private VariantRepositoryInterface $variant_repository_interface){}

    // public function all() : Collection
    // {
    //     return Category::with(['translation'])->latest()->get();
    // }
    public function getPaginated($perPage = null) : LengthAwarePaginator
    {
        return Product::with(['currentTranslation'])// need all
                        ->latest()
                        ->paginate($perPage ?? 20); 
    }

    public function store(array $data) : Product
    {
        $product = Product::create($data);
        $this->variant_repository_interface->store($data['variants'], $product);
        foreach($data['name'] as $key => $value){
            $product->translations()->create([
                'locale' => $key,
                'name' => $value,
                'description' => $data['description'][$key],
                'long_description' => $data['long_description'][$key],
                'meta_title' => $data['meta_title'][$key],
                'meta_description' => $data['meta_description'][$key],
            ]);
        }
        return $product;
    }

    public function findById($id) : Product{
        return Product::with([
            'category',
            'variants.color',
            'variants.size',
            'variants.inventory',
            'variants.inventory.warehouse',
            'currentTranslation',
            'translations'])
        ->findOrFail($id);
    }
    public function update(array $data) : Product{

      $product = Product::findOrFail($data['id']);
      $product->update($data);
      $product->variants()->delete();
      foreach ($data['variants'] as $variant) {
            $variantData = $product->variants()->create([
                'size_id'  => $variant['size_id'],
                'color_id' => $variant['color_id'],
                'price'    => $variant['price'],
                'sku'      => 10000 + $product->id . $variant['size_id'] . $variant['color_id'],
            ]);

            $variantData->inventory()->create([
                'warehouse_id'     => $variant['warehouse_id'],
                'quantity'         => $variant['quantity'],
                'minimum_quantity' => $variant['minimum_quantity'],
            ]);
      }
      $product->translations()->delete();
      foreach($data['name'] as $key => $value){
        $product->translations()->create([
            'locale' => $key,
            'name' => $value,
            'description' => $data['description'][$key],
            'long_description' => $data['long_description'][$key],
            'meta_title' => $data['meta_title'][$key],
            'meta_description' => $data['meta_description'][$key],
        ]);
      }
        return $product;
    }
}