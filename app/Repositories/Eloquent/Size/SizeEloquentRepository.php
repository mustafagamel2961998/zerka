<?php

namespace App\Repositories\Eloquent\Size;

use App\Models\Size;
use App\Repositories\Contracts\Size\SizeRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class SizeEloquentRepository implements SizeRepositoryInterface
{
    public function __construct(){}
    public function getPaginated($perPage=null) : LengthAwarePaginator{
     
        return Size::latest()->paginate($perPage ?? 20);
    }

    public function store(array $data) : Size{
        return Size::create($data);
    }

    // public function findById($id) : Color{
    //     return Color::find($id);
    // }

    // public function update(array $data) : Color{
    //     $color = $this->findById($data['id']);
    //     $color->update($data);
    //     return $color;
    // }
    // public function destroy($id) : bool{
    //     $color = $this->findById($id);
    //     return $color->delete();
    // }
}