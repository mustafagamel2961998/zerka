
    @php
        use App\Enums\Order\Status;
    @endphp
    <x-dashboard.layout title="{{ __('dashboard.dashboard') }}">


    <!-- Start here.... -->
    <div class="row">
        <div class="col-xxl-5">
            <div class="row">
                
                <div class="col-md-6">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-md bg-soft-primary rounded">
                                        <iconify-icon icon="solar:cart-5-bold-duotone"
                                            class="avatar-title fs-32 text-primary"></iconify-icon>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="text-muted mb-0 text-truncate">
                                        {{ __('dashboard.total_orders') }}
                                    </p>
                                    <h3 class="text-dark mt-1 mb-0">34</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer py-2 bg-light bg-opacity-50">
                            <div class="d-flex align-items-center justify-content-between">
                               
                                <a href="" class="text-reset fw-semibold fs-12">
                                    {{ __('dashboard.view_more') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-md bg-soft-primary rounded">
                                        <iconify-icon icon="solar:users-group-rounded-bold-duotone"
                                            class="avatar-title fs-32 text-primary"></iconify-icon>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="text-muted mb-0 text-truncate">
                                        {{ __('dashboard.total_users') }}
                                    </p>
                                    <h3 class="text-dark mt-1 mb-0">2</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer py-2 bg-light bg-opacity-50">
                            <div class="d-flex align-items-center justify-content-between">
                               
                                <a href="" class="text-reset fw-semibold fs-12">
                                     {{ __('dashboard.view_more') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-md bg-soft-primary rounded">
                                        <iconify-icon icon="solar:t-shirt-bold-duotone"
                                            class="avatar-title fs-32 text-primary"></iconify-icon>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="text-muted mb-0 text-truncate">
                                        {{ __('dashboard.total_products') }}
                                    </p>
                                    <h3 class="text-dark mt-1 mb-0">3</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer py-2 bg-light bg-opacity-50">
                            <div class="d-flex align-items-center justify-content-between">
                                
                                <a href="" class="text-reset fw-semibold fs-12">
                                     {{ __('dashboard.view_more') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-md bg-soft-primary rounded">
                                        <iconify-icon icon="solar:widget-5-bold-duotone"
                                            class="avatar-title fs-32 text-primary"></iconify-icon>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="text-muted mb-0 text-truncate">
                                        {{ __('dashboard.total_categories') }}
                                    </p>
                                    <h3 class="text-dark mt-1 mb-0">3</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer py-2 bg-light bg-opacity-50">
                            <div class="d-flex align-items-center justify-content-between">
                               
                                <a href="" class="text-reset fw-semibold fs-12">
                                     {{ __('dashboard.view_more') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end col -->

        <div class="col-xxl-7">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Performance</h4>
                        <div>
                            <button type="button" class="btn btn-sm btn-outline-light">ALL</button>
                            <button type="button" class="btn btn-sm btn-outline-light">1M</button>
                            <button type="button" class="btn btn-sm btn-outline-light">6M</button>
                            <button type="button" class="btn btn-sm btn-outline-light active">1Y</button>
                        </div>
                    </div> <!-- end card-title-->

                    <div dir="ltr">
                        <div id="dash-performance-chart" class="apex-charts"></div>
                    </div>
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Conversions</h5>
                    <div id="conversions" class="apex-charts mb-2 mt-n2"></div>
                    <div class="row text-center">
                        <div class="col-6">
                            <p class="text-muted mb-2">This Week</p>
                            <h3 class="text-dark mb-3">23.5k</h3>
                        </div> <!-- end col -->
                        <div class="col-6">
                            <p class="text-muted mb-2">Last Week</p>
                            <h3 class="text-dark mb-3">41.05k</h3>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                    <div class="text-center">
                        <button type="button" class="btn btn-light shadow-none w-100">View Details</button>
                    </div> <!-- end row -->
                </div>
            </div>
        </div> <!-- end left chart card -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sessions by Country</h5>
                    <div id="world-map-markers" style="height: 316px">
                    </div>
                    <div class="row text-center">
                        <div class="col-6">
                            <p class="text-muted mb-2">This Week</p>
                            <h3 class="text-dark mb-3">23.5k</h3>
                        </div> <!-- end col -->
                        <div class="col-6">
                            <p class="text-muted mb-2">Last Week</p>
                            <h3 class="text-dark mb-3">41.05k</h3>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div>
            </div> <!-- end card-->
        </div> <!-- end col -->

        <div class="col-lg-4">
            <div class="card card-height-100">
                <div class="card-header d-flex align-items-center justify-content-between gap-2">
                    <h4 class="card-title flex-grow-1">Top Pages</h4>

                    <a href="#" class="btn btn-sm btn-soft-primary">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap table-centered m-0">
                        <thead class="bg-light bg-opacity-50">
                            <tr>
                                <th class="text-muted ps-3">Page Path</th>
                                <th class="text-muted">Page Views</th>
                                <th class="text-muted">Exit Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-3"><a href="#" class="text-muted">larkon/ecommerce.html</a>
                                </td>
                                <td>465 </td>
                                <td><span class="badge badge-soft-success">4.4%</span></td>
                            </tr>
                            <tr>
                                <td class="ps-3"><a href="#" class="text-muted">larkon/dashboard.html</a>
                                </td>
                                <td> 426</td>
                                <td><span class="badge badge-soft-danger">20.4%</span></td>
                            </tr>
                            <tr>
                                <td class="ps-3"><a href="#" class="text-muted">larkon/chat.html</a></td>
                                <td>254 </td>
                                <td><span class="badge badge-soft-warning">12.25%</span></td>
                            </tr>
                            <tr>
                                <td class="ps-3"><a href="#" class="text-muted">larkon/auth-login.html</a>
                                </td>
                                <td> 3369</td>
                                <td><span class="badge badge-soft-success">5.2%</span></td>
                            </tr>
                            <tr>
                                <td class="ps-3"><a href="#" class="text-muted">larkon/email.html</a></td>
                                <td>985 </td>
                                <td><span class="badge badge-soft-danger">64.2%</span></td>
                            </tr>
                            <tr>
                                <td class="ps-3"><a href="#" class="text-muted">larkon/social.html</a></td>
                                <td>653 </td>
                                <td><span class="badge badge-soft-success">2.4%</span></td>
                            </tr>
                            <tr>
                                <td class="ps-3"><a href="#" class="text-muted">larkon/blog.html</a></td>
                                <td>478 </td>
                                <td><span class="badge badge-soft-danger">1.4%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-xl-4 d-none">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Recent Transactions</h4>
                    <div>
                        <a href="#!" class="btn btn-sm btn-primary">
                            <i class="bx bx-plus me-1"></i>Add
                        </a>
                    </div>
                </div> <!-- end card-header-->
                <div class="card-body p-0">
                    <div class="px-3" data-simplebar style="max-height: 398px;">
                        <table class="table table-hover mb-0 table-centered">
                            <tbody>
                                <tr>
                                    <td>24 April, 2024</td>
                                    <td>$120.55</td>
                                    <td><span class="badge bg-success">Cr</span></td>
                                    <td>Commisions </td>
                                </tr>
                                <tr>
                                    <td>24 April, 2024</td>
                                    <td>$9.68</td>
                                    <td><span class="badge bg-success">Cr</span></td>
                                    <td>Affiliates </td>
                                </tr>
                                <tr>
                                    <td>20 April, 2024</td>
                                    <td>$105.22</td>
                                    <td><span class="badge bg-danger">Dr</span></td>
                                    <td>Grocery </td>
                                </tr>
                                <tr>
                                    <td>18 April, 2024</td>
                                    <td>$80.59</td>
                                    <td><span class="badge bg-success">Cr</span></td>
                                    <td>Refunds </td>
                                </tr>
                                <tr>
                                    <td>18 April, 2024</td>
                                    <td>$750.95</td>
                                    <td><span class="badge bg-danger">Dr</span></td>
                                    <td>Bill Payments </td>
                                </tr>
                                <tr>
                                    <td>17 April, 2024</td>
                                    <td>$455.62</td>
                                    <td><span class="badge bg-danger">Dr</span></td>
                                    <td>Electricity </td>
                                </tr>
                                <tr>
                                    <td>17 April, 2024</td>
                                    <td>$102.77</td>
                                    <td><span class="badge bg-success">Cr</span></td>
                                    <td>Interest </td>
                                </tr>
                                <tr>
                                    <td>16 April, 2024</td>
                                    <td>$79.49</td>
                                    <td><span class="badge bg-success">Cr</span></td>
                                    <td>Refunds </td>
                                </tr>
                                <tr>
                                    <td>05 April, 2024</td>
                                    <td>$980.00</td>
                                    <td><span class="badge bg-danger">Dr</span></td>
                                    <td>Shopping</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">
                           {{__('dashboard.recent_orders')}}
                        </h4>
                    </div>
                </div>
                <!-- end card body -->
                <div class="table-responsive table-centered">
                    <table id="my-order-html-table" class="table align-middle mb-0 table-hover table-centered">
                        <thead class="bg-light-subtle">
                            <tr>
                                <th>{{__('global.order_number')}}</th>
                                <th>{{__('global.customer')}}</th>
                                <th>{{__('global.items_count')}}</th>
                                <th>{{__('global.coupon_code')}}</th>
                                <th>{{__('global.payment_status')}}</th>
                                <th>{{__('global.created_at')}}</th>
                                <th>{{__('global.grand_total')}}</th>
                                <th>{{ __('global.status') }}</th>
                                <th>{{ __('global.action') }}</th>
                            </tr> 
                            
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        <a href="#!" class="link-primary fw-medium">
                                            #{{$order->order_number}}
                                        </a>
                                    </td>
                                    <td>
                                        
                                        <a href="#!" class="link-primary fw-medium">
                                            <span class="d-flex align-items-center">
                                                <img class="rounded-circle" width="32" src="{{$order->user->getFirstMediaUrl('avatar')}}" loading="lazy" alt="{{$order->user->profile->first_name .' '.$order->user->profile->last_name}}">
                                                {{$order->user->profile->first_name .' '.$order->user->profile->last_name}}
                                            </span>
                                        </a>
                                    </td>
                                    
                                    <td>
                                        {{ $order->items_count }}
                                    </td>
                                
                                    <td> 
                                        {{$order->coupon_code ? $order->coupon_code : '-'}}
                                    </td>
                                    <td>
                                    @switch($order->payment_status?->value)
                                        @case('paid')
                                            <span class="badge  bg-success text-light px-2 py-1 fs-13">
                                                {{__('global.paid')}}
                                            </span>
                                            @break
                                            @case('failed')
                                                <span class="badge  bg-danger text-light px-2 py-1 fs-13">
                                                    {{__('global.failed')}}
                                                </span>
                                            @break
                                        @default
                                            <span class="badge  bg-warning text-light px-2 py-1 fs-13">
                                                {{__('global.pending')}}
                                            </span>   
                                    @endswitch
                                    </td>
                                    <td> 
                                    @php
                                        $orderTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at->toDateTimeString(), config('app_settings.timezone'));
                                    @endphp

                                    {{ $orderTime->translatedFormat('Y-m-d') }} /
                                    <small class="text-muted">({{ $orderTime->diffForHumans() }})</small>
                                    </td>
                                    <td> 
                                        {{ format_currency($order->grand_total,current_currency_code()) }}
                                    </td>
                                    <td>
                                        @switch($order->status?->value)
                                            @case('processing')
                                                <span class="badge border border-warning text-warning px-2 py-1 fs-13">
                                                    {{__('global.processing')}}
                                                </span>
                                                @break
                                            @case('shipped')
                                                <span class="badge border border-primary text-primary px-2 py-1 fs-13">
                                                    {{__('global.shipped')}}
                                                </span>
                                                @break
                                            @case('delivering')
                                                <span class="badge border border-info text-info px-2 py-1 fs-13">
                                                    {{__('global.delivering')}}
                                                </span>
                                                @break
                                        @case('received')
                                                <span class="badge border px-2 py-1 fs-13" style="color: #ff6c2f !important; border-color: #ff6c2f !important;">
                                                    {{ __('global.order_received') }}
                                                </span>
                                            @break 
                                            @case('completed')
                                                <span class="badge border border-success text-success px-2 py-1 fs-13">
                                                    {{__('global.completed')}}
                                                </span>
                                                @break            
                                            @case('cancelled')
                                                <span class="badge border border-danger text-danger px-2 py-1 fs-13">
                                                    {{__('global.cancelled')}}
                                                </span>
                                                @break
                                            @default
                                                <span class="badge border border-secondary text-secondary px-2 py-1 fs-13">
                                                    {{__('global.pending')}}
                                                </span>
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('dashboard.v1.invoices.show', $order->invoice->id) }}" class="btn btn-soft-secondary btn-sm">
                                                <iconify-icon icon="solar:bill-list-broken" class="align-middle fs-18"></iconify-icon>
                                            </a>
                                            <a href="{{route('dashboard.v1.orders.show', $order->id)}}" class="btn btn-light btn-sm">
                                                <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                                            </a>
                                            
                                            <a href="{{route('dashboard.v1.orders.show', $order->id)}}" class="btn btn-soft-primary btn-sm">
                                                <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon>
                                            </a>
                                            @if ($order->status?->value === Status::PENDING->value)
                                                <a href="#!" class="btn btn-soft-danger btn-sm">
                                                    <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon>
                                                </a>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                
                        </tbody>
                    </table>
                    <!-- end table -->
                </div>
                <!-- table responsive -->

            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</x-dashboard.layout>
