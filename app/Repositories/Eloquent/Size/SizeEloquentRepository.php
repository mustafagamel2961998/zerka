<?php

namespace App\Repositories\Eloquent\Size;

use App\Models\Size;
use App\Repositories\Contracts\Size\SizeRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SizeEloquentRepository implements SizeRepositoryInterface
{
    public function __construct(){}
    public function all() : Collection{
        return Size::where('status','active')->latest()->get();
    }
    public function getPaginated($perPage=null) : LengthAwarePaginator{
     
        return Size::latest()->paginate($perPage ?? 20);
    }

    public function store(array $data) : Size{
        return Size::create($data);
    }

    public function findById($id) : Size{
        return Size::find($id);
    }

    public function update(array $data) : Size{
        $size = $this->findById($data['id']);
        $size->update($data);
        return $size;
    }
    public function destroy($id) : bool{
        $size = $this->findById($id);
        return $size->delete();
    }
}