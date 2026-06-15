<?php

namespace App\Http\Controllers\Web\Dashboard\V1\Size;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Size\SizeRepositoryInterface;
use App\Models\Size;
use App\Http\Requests\Dashboard\V1\Size\SizeRequest;
use App\Actions\Dashboard\V1\Size\CreateAction;
use App\DTOs\Dashboard\V1\Size\CreateDTO;
class SizeController extends Controller
{
    public function __construct(private SizeRepositoryInterface $size_repository_interface) {}

    public function index(){
        $sizes = $this->size_repository_interface->getPaginated();
        return view('dashboard.Size.index', compact('sizes'));
    }
    public function create()
    {
        $size = new Size();
        return view('dashboard.Size.create',compact('size'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SizeRequest $request,CreateAction $create_action)
    {
        $dto = CreateDTO::fromRequest($request);
        $create_action->execute($dto);
        return redirect()->route('dashboard.v1.sizes.index')->with('success', __('crud.created'));
    }
}
