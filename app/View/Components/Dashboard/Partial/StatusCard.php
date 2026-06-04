<?php

namespace App\View\Components\Dashboard\Partial;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $counts)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.partial.status-card', [
            'counts' => $this->counts
        ]);
    }
}
