<?php

namespace App\View\Components\Dashboard\Partial\Order;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Order;
use App\Enums\Order\Status;
class Statistics extends Component
{
    public $counts;
    public function __construct()
    {
        $rawQueries = collect(Status::cases())->map(function ($status) {
            return "sum(case when status = '{$status->value}' then 1 else 0 end) as {$status->value}_count";
        })->prepend('count(*) as total')->implode(', ');

        $this->counts = Order::selectRaw($rawQueries)->first();
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.partial.order.statistics');
    }
}
