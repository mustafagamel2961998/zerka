<?php

namespace App\Repositories\Eloquent\Color;

use App\Models\Color;
use App\Repositories\Contracts\Color\ColorRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ColorEloquentRepository implements ColorRepositoryInterface
{
    public function __construct()
    {
        //
    }
    public function getPaginated($perPage=null) : LengthAwarePaginator{
     
        return Color::latest()->paginate($perPage ?? 20);
    }

    public function store(array $data) : Color{
        return Color::create($data);
    }

    public function findById($id) : Color{
        return Color::find($id);
    }

    public function update(array $data) : Color{
        $color = $this->findById($data['id']);
        $color->update($data);
        return $color;
    }
    public function destroy($id) : bool{
        $color = $this->findById($id);
        return $color->delete();
    }
}