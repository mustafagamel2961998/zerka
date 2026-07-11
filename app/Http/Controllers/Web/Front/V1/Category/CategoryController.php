<?php

namespace App\Http\Controllers\Web\Front\V1\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\Color;
use App\Repositories\Contracts\Category\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    public function __construct(private CategoryRepositoryInterface $category_repository_interface) {}

    public function show($id, Request $request)
    {
        $category = $this->category_repository_interface->findById($id);

        // لو التصنيف ده مالوش تصنيفات فرعية، نوديه مباشرة لصفحة المنتجات
        if ($category->children->isEmpty()) {
            return redirect()->route('categories.products', ['id' => $category->id, 'slug' => $category->slug]);
        }

        return view('front.category.show', compact('category'));
    }

    public function products($id, Request $request)
    {
        $category = $this->category_repository_interface->findById($id);

        $query = $category->products()
            ->active()
            ->with([
                'currentTranslation',
                'minVariantPrice',
            ]);

        if ($request->filled('sizes')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->whereIn('size_id', $request->sizes);
            });
        }

        if ($request->filled('colors')) {
            $query->whereHas('variants.colors', function ($q) use ($request) {
                $q->whereIn('color_id', $request->colors);
            });
        }

        if ($request->filled('min_price') || $request->filled('max_price')) {
            $query->whereHas('variants', function ($q) use ($request) {
                if ($request->filled('min_price')) {
                    $q->where('price', '>=', $request->min_price);
                }
                if ($request->filled('max_price')) {
                    $q->where('price', '<=', $request->max_price);
                }
            });
        }

        switch ($request->get('sort')) {
            case 'price_asc':
                $query->orderBy(
                    \App\Models\ProductVariant::select('price')
                        ->whereColumn('product_id', 'products.id')
                        ->orderBy('price', 'asc')
                        ->limit(1),
                    'asc'
                );
                break;

            case 'price_desc':
                $query->orderBy(
                    \App\Models\ProductVariant::select('price')
                        ->whereColumn('product_id', 'products.id')
                        ->orderBy('price', 'asc')
                        ->limit(1),
                    'desc'
                );
                break;

            case 'oldest':
                $query->oldest();
                break;

            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12)->withQueryString();

        $sizes = Size::active()
            ->whereHas('variants.product', function ($q) use ($category) {
                $q->where('category_id', $category->id)->active();
            })
            ->get();

        $colors = Color::whereHas('variantColors.variant.product', function ($q) use ($category) {
            $q->where('category_id', $category->id)->active();
        })->get();
        return view('front.category.product', compact('category', 'products', 'sizes', 'colors'));
    }
}