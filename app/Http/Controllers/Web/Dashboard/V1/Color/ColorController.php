<?php

namespace App\Http\Controllers\Web\Dashboard\V1\Color;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Repositories\Contracts\Color\ColorRepositoryInterface;
use App\Http\Requests\Dashboard\V1\Color\ColorRequest;
use App\Actions\Dashboard\V1\Color\CreateAction;
use App\Actions\Dashboard\V1\Color\UpdateAction;
use App\DTOs\Dashboard\V1\Color\CreateDTO;
use App\DTOs\Dashboard\V1\Color\UpdateDTO;
class ColorController extends Controller
{

    public function __construct(protected ColorRepositoryInterface $color_repository_interface) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = $this->color_repository_interface->getPaginated();
        return view('dashboard.color.index',compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $color = new Color();
        return view('dashboard.color.create',compact('color'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorRequest $request,CreateAction $create_action)
    {
        $dto = CreateDTO::fromRequest($request);
        $create_action->execute($dto);
        return redirect()->route('dashboard.v1.colors.index')->with('success', __('crud.created'));
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
        $color = $this->color_repository_interface->findById($id);
        return view('dashboard.color.edit',compact('color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ColorRequest $request,UpdateAction $update_action, string $id)
    {
        $dto = UpdateDTO::fromRequest($request);
        $update_action->execute($dto);
        return redirect()->route('dashboard.v1.colors.index')->with('success', __('crud.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->color_repository_interface->destroy($id);
        return redirect()->route('dashboard.v1.colors.index')->with('success', __('crud.deleted'));
    }
}
