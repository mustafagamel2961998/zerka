<?php

namespace App\View\Components\Dashboard\Partial\Size;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Size;
use App\Enums\Status;

class Statistics extends Component
{
    /**
     * Create a new component instance.
     */
    public $counts;
    public function __construct()
    {
        $this->counts = Size::selectRaw("
            count(*) as total,
            sum(case when status = '" . Status::ACTIVE->value . "' then 1 else 0 end) as active_count,
            sum(case when status = '" . Status::INACTIVE->value . "' then 1 else 0 end) as inactive_count
        ")->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.partial.size.statistics');
    }
}
