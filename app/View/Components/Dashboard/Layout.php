<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Order;
use App\Models\Refund;
class Layout extends Component
{
    /**
     * Create a new component instance.
     */
    public $pendingOrdersCount;
    public $pendingRefundCount;
    public function __construct(public $title)
    {
        $this->title = config('app.name') . ' - ' . $title;
        $this->pendingOrdersCount = Order::where('status', 'pending')->count();
        $this->pendingRefundCount = Refund::where('status', 'pending')->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.layout');
    }
}
