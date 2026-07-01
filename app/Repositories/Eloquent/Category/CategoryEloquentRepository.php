<?php

namespace App\Repositories\Eloquent\Category;
use App\Repositories\Contracts\Category\CategoryRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
class CategoryEloquentRepository implements CategoryRepositoryInterface
{
    public function baseQuery() : Builder
    {
        return Category::query();
    }

    public function all() : Collection
    {
        return Category::where('status','active')->with(['currentTranslation:id,category_id,name'])->latest()->get();
    }
    public function getPaginated($perPage = null) : LengthAwarePaginator
    {
        return Category::with(['currentTranslation'])// need all
                        ->withCount(['children'])
                        ->latest()
                        ->paginate($perPage ?? 20); 
    }

    public function store(array $data) : Category
    {
        $category = Category::create($data);
        foreach($data['name'] as $key => $value){
            $category->translations()->create([
                'locale' => $key,
                'name' => $value,
                'description' => $data['description'][$key],
                'meta_title' => $data['meta_title'][$key],
                'meta_description' => $data['meta_description'][$key],
            ]);
        }
        return $category;
    }

    public function findById($id) : Category{
        return Category::with([
            'currentTranslation',
            'translations'])
        ->findOrFail($id);
    }
    public function update($id, array $data) : Category{
        $category = $this->findById($id);
        $category->update($data);
        foreach($data['name'] as $key => $value){
            $category->translations()->updateOrCreate([
                'locale' => $key,
            ],[
                'name' => $value,
                'description' => $data['description'][$key],
                'meta_title' => $data['meta_title'][$key],
                'meta_description' => $data['meta_description'][$key],
            ]);
        }
        return $category;
    }

    public function destroy($id) : bool{
        $category = $this->findById($id);
        return $category->delete();
    }
}