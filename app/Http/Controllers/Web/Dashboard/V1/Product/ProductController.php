<?php

namespace App\Http\Controllers\Web\Dashboard\V1\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\Product\ProductRepositoryInterface;
class ProductController extends Controller
{
    public function __construct(private ProductRepositoryInterface $product_repository_interface){}
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
