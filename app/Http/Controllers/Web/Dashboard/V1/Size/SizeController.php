<?php

namespace App\Http\Controllers\Web\Dashboard\V1\Size;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Size\SizeRepositoryInterface;
use App\Models\Size;
use App\Http\Requests\Dashboard\V1\Size\SizeRequest;
use App\Actions\Dashboard\V1\Size\CreateAction;
use App\Actions\Dashboard\V1\Size\UpdateAction;
use App\DTOs\Dashboard\V1\Size\CreateDTO;
use App\DTOs\Dashboard\V1\Size\UpdateDTO;

class SizeController extends Controller
{
    public function __construct(private SizeRepositoryInterface $size_repository_interface) {}

    public function index(){
        $sizes = $this->size_repository_interface->getPaginated();
        return view('dashboard.size.index', compact('sizes'));
    }
    public function create()
    {
        $size = new Size();
        return view('dashboard.size.create',compact('size'));
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
     /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $size = $this->size_repository_interface->findById($id);
        return view('dashboard.size.edit',compact('size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SizeRequest $request,UpdateAction $update_action, string $id)
    {
        $dto = UpdateDTO::fromRequest($request);
        $update_action->execute($dto);
        return redirect()->route('dashboard.v1.sizes.index')->with('success', __('crud.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->size_repository_interface->destroy($id);
        return redirect()->route('dashboard.v1.sizes.index')->with('success', __('crud.deleted'));
    }
}
