<?php

namespace App\Repositories\Eloquent\Product;
use App\Repositories\Contracts\Product\ProductRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Product;
use App\Repositories\Contracts\Variant\VariantRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class ProductEloquentRepository implements ProductRepositoryInterface
{
    public function __construct(private VariantRepositoryInterface $variant_repository_interface){}

    public function baseQuery() : Builder
    {
        return Product::query();
    }
    // public function all() : Collection{
    //     return Product::latest()->get();
    // }
    public function getPaginated($perPage = null) : LengthAwarePaginator
    {
        return Product::with(['currentTranslation'])// need all
                        ->latest()
                        ->paginate($perPage ?? 20); 
    }

    public function store(array $data) 
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
            'media',
            'category',
            'minVariantPrice',
            'variants.size',
            'variants.colors.color',
            'variants.colors.inventory',
            'variants.colors.inventory.warehouse',
            'currentTranslation',
            'translations'])
        ->findOrFail($id);
    }
    public function update(array $data) : Product{

      $product = Product::findOrFail($data['id']);
      $product->update($data);
      
      $product->variants()->delete();
      $this->variant_repository_interface->store($data['variants'], $product);
      


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