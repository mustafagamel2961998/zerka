<?php

namespace App\Http\Controllers\Web\Front\V1\Product;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Product\ProductRepositoryInterface;
class ProductController extends Controller
{
    public function __construct(private ProductRepositoryInterface $product_repository_interface){}
    public function show($id,$slug){
         $product = $this->product_repository_interface->baseQuery()
         ->with([
            'media',
            'category',
            'variants'=>fn($q)=>$q->whereHas('size',fn($q)=>$q->active())->with('size'),
            'variants.colors'=>fn($q)=>$q->whereHas('color',fn($q)=>$q->active())->with('color','inventory','inventory.warehouse'),
            'currentTranslation',
         ])
        ->find($id);
         return view('front.product.show',compact('product'));
    }
}
