<?php

namespace App\View\Components\Front;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    /**
     * Create a new component instance.
     */
    public $cart;
    public function __construct(public $title)
    {
        $this->title = config('app.name') . ' - ' . $title;
        if(auth()->check() && auth()->user()->cart){
            $this->cart = auth()->user()->cart->with('items')->first();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.layout');
    }
}
