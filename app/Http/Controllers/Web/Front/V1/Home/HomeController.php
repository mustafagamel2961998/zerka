<?php

namespace App\Http\Controllers\Web\Front\V1\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Category\CategoryRepositoryInterface;
use App\Repositories\Contracts\Product\ProductRepositoryInterface;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function __construct(
        private CategoryRepositoryInterface $category_repository_interface,
        private ProductRepositoryInterface $product_repository_interface,
    ){}
    public function index(){
    // Get 3 Categories
    $categories = $this->category_repository_interface
                ->baseQuery()
                ->active()
                ->with([
                    'currentTranslation:id,category_id,locale,name',
                    'media'
                ])
                ->take(3)
                ->get();    
    //-----------------------------------------------------------------------------//
    // Get first 4 Products
    $first_products = $this->product_repository_interface
                ->baseQuery()
                ->active()
                ->with([
                    'currentTranslation:id,product_id,locale,name',
                    'media',
                    'minVariantPrice'
                ])
                ->take(4)
                ->get();
    //-----------------------------------------------------------------------------//
    // Get last 4 Products for new arrivals
    $new_arrivals = $this->product_repository_interface
                ->baseQuery()
                ->active()
                ->latest()
                ->with([
                    'currentTranslation:id,product_id,locale,name',
                    'media',
                    'minVariantPrice'
                ])
                ->take(4)
                ->get();
        return view('front.home.index',compact(
            'categories',
            'first_products',
            'new_arrivals'
            ));
    }
}
