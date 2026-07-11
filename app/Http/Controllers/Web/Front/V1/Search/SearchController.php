<?php

namespace App\Http\Controllers\Web\Front\V1\Search;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function products(Request $request)
    {
        $query = trim($request->get('q', ''));

        if (mb_strlen($query) < 2) {
            return response()->json(['products' => []]);
        }

        $products = Product::active()
            ->whereHas('translations', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->with(['currentTranslation', 'minVariantPrice'])
            ->limit(8)
            ->get();

        $results = $products->map(function ($product) {
            return [
                'id'    => $product->id,
                'slug'  => $product->slug,
                'name'  => $product->currentTranslation?->name ?? $product->translations->first()?->name,
                'image' => $product->getFirstMediaUrl('images', 'thumb'),
                'price' => format_currency($product->minVariantPrice?->price ?? 0, current_currency_code()),
                'url'   => route('products.show', ['id' => $product->id, 'slug' => $product->slug]),
            ];
        });

        return response()->json(['products' => $results]);
    }
}