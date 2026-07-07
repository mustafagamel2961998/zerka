<?php

namespace App\View\Components\Front;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;
class Layout extends Component
{
    /**
     * Create a new component instance.
     */
    public $cart;
    public $navbar_categories;
    public function __construct(public $title)
    {
        $this->title = config('app.name') . ' - ' . $title;
        if(auth()->check() && auth()->user()->cart){
            $this->cart = auth()->user()->cart->with('items')->first();
        }
        $this->navbar_categories = Category::where('parent_id', null)
        ->where('is_menu', true)
        ->with(['currentTranslation:id,category_id,name','children.currentTranslation:id,category_id,name'])
        ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.layout');
    }
}
