<?php

namespace App\Http\Controllers\Web\Dashboard\V1\Category;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Category\CategoryRepositoryInterface;
use App\Models\Category;
use App\Http\Requests\Dashboard\V1\Category\CategoryRequest;
use App\Actions\Dashboard\V1\Category\CreateAction;
use App\Actions\Dashboard\V1\Category\UpdateAction;
use App\DTOs\Dashboard\V1\Category\CreateDTO;
use App\DTOs\Dashboard\V1\Category\UpdadteDTO;
class CategoryController extends Controller
{
    public function __construct(
        protected CategoryRepositoryInterface $category_repository_interface
    ){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->category_repository_interface->getPaginated();
        return view('dashboard.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();
        $categories = $this->category_repository_interface->all();
        return view('dashboard.category.create',compact('category','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request,CreateAction $create_action)
    {
        $dto = CreateDTO::fromRequest($request);
        $create_action->execute($dto);
        return redirect()->route('dashboard.v1.categories.index')->with('success', __('crud.created'));
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
        $category = $this->category_repository_interface->findById($id);
        $categories = $this->category_repository_interface->all();
        return view('dashboard.category.edit',compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id,UpdateAction $update_action)
    {
        $dto = UpdadteDTO::fromRequest($request);
        $update_action->execute($id, $dto);
        return redirect()->route('dashboard.v1.categories.index')->with('success', __('crud.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
