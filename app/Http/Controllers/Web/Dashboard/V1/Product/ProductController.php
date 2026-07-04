<?php

namespace App\Http\Controllers\Web\Dashboard\V1\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\Product\ProductRepositoryInterface;
use App\Repositories\Contracts\Category\CategoryRepositoryInterface;
use App\Repositories\Contracts\Warehouse\WarehouseRepositoryInterface;
use App\Repositories\Contracts\Size\SizeRepositoryInterface;
use App\Repositories\Contracts\Color\ColorRepositoryInterface;
use App\Models\Product;
use App\Http\Requests\Dashboard\V1\Product\ProductRequest;
use App\Actions\Dashboard\V1\Product\CreateAction;
use App\Actions\Dashboard\V1\Product\UpdateAction;
use App\DTOs\Dashboard\V1\Product\CreateDTO;
use App\DTOs\Dashboard\V1\Product\UpdateDTO;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class ProductController extends Controller
{
    public function __construct(
        private ProductRepositoryInterface $product_repository_interface,
        private CategoryRepositoryInterface $category_repository_interface,
        private WarehouseRepositoryInterface $warehouse_repository_interface,
        private SizeRepositoryInterface $size_repository_interface,
        private ColorRepositoryInterface $color_repository_interface
    ){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->product_repository_interface->getPaginated();
        return view('dashboard.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $categories = $this->category_repository_interface->all();
        $warehouses = $this->warehouse_repository_interface->all();
        $sizes = $this->size_repository_interface->all();
        $colors = $this->color_repository_interface->all();
        return view('dashboard.product.create',compact('product','categories','warehouses','sizes','colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request,CreateAction $create_action)
    {
        $dto = CreateDTO::fromRequest($request);
        $create_action->execute($dto);
        return redirect()->route('dashboard.v1.products.index')->with('success', __('crud.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->product_repository_interface->findById($id);
        
        return view('dashboard.product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = $this->product_repository_interface->findById($id);
        $categories = $this->category_repository_interface->all();
        $warehouses = $this->warehouse_repository_interface->all();
        $sizes = $this->size_repository_interface->all();
        $colors = $this->color_repository_interface->all();
        return view('dashboard.product.edit',compact(
            'product',
            'categories',
            'warehouses',
            'sizes',
            'colors'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, UpdateAction $update_action,string $id)
    {
        $dto = UpdateDTO::fromRequest($request);
        $update_action->execute($dto);
        return redirect()->route('dashboard.v1.products.index')->with('success', __('crud.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function destroyMedia(Media $media){
        $media->delete();
        return response()->json(['success' => true]);
    }
}
