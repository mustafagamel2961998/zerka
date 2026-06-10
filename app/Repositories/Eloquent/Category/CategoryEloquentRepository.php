<?php

namespace App\Repositories\Eloquent\Category;
use App\Repositories\Contracts\Category\CategoryRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Category;
class CategoryEloquentRepository implements CategoryRepositoryInterface
{
    public function __construct()
    {
        //
    }

    public function getPaginated($perPage = null) : LengthAwarePaginator
    {
        return Category::with([
            'translation:id,city_id,name',
        ])
        ->latest()
        ->paginate($perPage ?? 20); 
    }
}