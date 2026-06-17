<?php

namespace App\Repositories\Eloquent\Category;
use App\Repositories\Contracts\Product\ProductRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Category;
use Illuminate\Support\Collection;
class ProductEloquentRepository implements ProductRepositoryInterface
{
    public function __construct()
    {
        //
    }

    // public function all() : Collection
    // {
    //     return Category::with(['translation'])->latest()->get();
    // }
    // public function getPaginated($perPage = null) : LengthAwarePaginator
    // {
    //     return Category::with(['translation'])// need all
    //                     ->withCount(['children'])
    //                     ->latest()
    //                     ->paginate($perPage ?? 20); 
    // }

    // public function store(array $data) : Category
    // {
    //     $category = Category::create($data);
    //     foreach($data['name'] as $key => $value){
    //         $category->translations()->create([
    //             'locale' => $key,
    //             'name' => $value,
    //             'description' => $data['description'][$key],
    //             'meta_title' => $data['meta_title'][$key],
    //             'meta_description' => $data['meta_description'][$key],
    //         ]);
    //     }
    //     return $category;
    // }

    // public function findById($id) : Category{
    //     return Category::with([
    //         'translation',
    //         'translations'])
    //     ->findOrFail($id);
    // }
    // public function update($id, array $data) : Category{
    //     $category = $this->findById($id);
    //     $category->update($data);
    //     foreach($data['name'] as $key => $value){
    //         $category->translations()->updateOrCreate([
    //             'locale' => $key,
    //         ],[
    //             'name' => $value,
    //             'description' => $data['description'][$key],
    //             'meta_title' => $data['meta_title'][$key],
    //             'meta_description' => $data['meta_description'][$key],
    //         ]);
    //     }
    //     return $category;
    // }
}