 <x-dashboard.layout title="{{ __('dashboard.orders') }}">

     <div class="row">
         <div class="col-xl-9 col-lg-8">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-body">
                             <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                 <div>
                                     <h4 class="fw-medium text-dark d-flex align-items-center gap-2">#{{$order->order_number}} 
                                    <span>
                                        {{__('global.payment_status')}} :
                                    </span>
                                    
                                     @switch($order->payment_status)
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
                                        <span>
                                            {{__('global.order_status')}} :
                                        </span>
                                        
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
                                                    {{__('global.order_delivering')}}
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
                                        </h4>
                                    <div class="d-flex flex-column gap-1">
                                        <a href="#!" class="fw-bold text-primary text-decoration-none fs-15 d-inline-flex align-items-center gap-1">
                                            <i class="ri-user-line font-size-14"></i> <!-- أيقونة مستخدم خفيفة -->
                                            {{ $order->user?->profile?->first_name . ' ' . $order->user?->profile?->last_name }}
                                            <span class="badge bg-light text-muted fw-normal ms-1 fs-12 border">
                                                {{ $order->created_at->diffForHumans() }}
                                            </span>
                                        </a> 

                                        <p class="mb-0 text-muted fs-13 d-flex align-items-center gap-3">
                                            <span class="d-flex align-items-center gap-1">
                                                <i class="ri-calendar-todo-line text-secondary"></i>
                                                <span class="fw-medium text-dark">{{ $order->created_at->format('Y-m-d') }}</span>
                                            </span> 
                                            
                                            <span class="d-flex align-items-center gap-1">
                                                <i class="ri-time-line text-secondary"></i>
                                                <span class="fw-medium text-dark">{{ $order->created_at->format('h:i A') }}</span>
                                            </span>
                                        </p>
                                    </div>
                                    
                                 </div>
                                 

                             </div>

                             <div class="mt-4">
                                 <h4 class="fw-medium text-dark">
                                    {{__('global.order_tracking')}}
                                 </h4>
                             </div>
                        <div class="row d-xxl-flex flex-xxl-nowrap row-cols-md-4 row-cols-2 g-3" id="order-status-steps" data-order-id="{{ $order->id }}">
                            
                            @php
                                $steps = [
                                    \App\Enums\Order\Status::PENDING->value     => ['label' => __('global.pending'),          'color' => 'secondary'],
                                    \App\Enums\Order\Status::PROCESSING->value  => ['label' => __('global.processing'),       'color' => 'warning'],
                                    \App\Enums\Order\Status::PACKED->value      => ['label' => __('global.packed') ?? 'Packed', 'color' => 'dark'], 
                                    \App\Enums\Order\Status::SHIPPED->value     => ['label' => __('global.order_shipped'),   'color' => 'primary'],
                                    \App\Enums\Order\Status::DELIVERING->value  => ['label' => __('global.order_delivering'), 'color' => 'info'],
                                    \App\Enums\Order\Status::RECEIVED->value    => ['label' => __('global.order_received'),   'color' => 'indigo-style'], // خليناها كيد عشان نقراها تحت بالـ style
                                    \App\Enums\Order\Status::COMPLETED->value   => ['label' => __('global.completed'),        'color' => 'success'],
                                ];

                                $currentStatus = $order->status->value;
                                $statusKeys = array_keys($steps);
                                $currentIndex = array_search($currentStatus, $statusKeys);
                                if ($currentIndex === false) $currentIndex = 0; 
                            @endphp

                            @foreach($steps as $statusValue => $stepData)
                                @php
                                    $stepIndex = array_search($statusValue, $statusKeys);
                                    
                                    // تظبيط الألوان والـ width
                                    if ($stepIndex < $currentIndex) {
                                        $width = '100%';
                                        $barColor = 'bg-success';
                                        $isCurrent = false;
                                    } elseif ($stepIndex == $currentIndex) {
                                        $width = '60%'; 
                                        $barColor = $stepData['color'] == 'indigo-style' ? '' : 'bg-' . $stepData['color'];
                                        $isCurrent = true;
                                    } else {
                                        $width = '0%';
                                        $barColor = 'bg-opacity-25 bg-secondary';
                                        $isCurrent = false;
                                    }
                                @endphp

                                {{-- جعل كل col يأخذ مساحة متساوية في الشاشات الكبيرة جداً (100% تقسيم 7 طلبات) --}}
                                <div class="col" style="flex: 1 0 0%;">
                                    <div class="progress mt-3" style="height: 10px;">
                                        <div class="progress-bar progress-bar-striped {{ $isCurrent ? 'progress-bar-animated' : '' }} {{ $barColor }}"
                                            role="progressbar" 
                                            style="width: {{ $width }}; {{ ($isCurrent && $stepData['color'] == 'indigo-style') ? 'background-color: #563d7c !important;' : '' }}" 
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex align-items-center gap-2 mt-2">
                                        @php
                                            // ضبط لون الكلام للـ RECEIVED المخصصة
                                            $textStyle = '';
                                            if ($isCurrent) {
                                                if ($stepData['color'] == 'indigo-style') {
                                                    $textStyle = 'color: #563d7c !important;';
                                                } else {
                                                    $textStyle = ''; // سيعتمد على كلاس الـ Bootstrap المكتوب في الـ class تحت
                                                }
                                            }
                                        @endphp
                                        <button type="button" 
                                                class="btn btn-link p-0 text-decoration-none text-dark fw-bold status-update-btn {{ ($isCurrent && $stepData['color'] != 'indigo-style') ? 'text-'.$stepData['color'] : '' }}" 
                                                data-status="{{ $statusValue }}"
                                                style="cursor: pointer; text-align: left; {{ $textStyle }} font-size: 13px; white-space: nowrap;">
                                            {{ $stepData['label'] }}
                                        </button>
                                        
                                        @if($isCurrent && $statusValue !== \App\Enums\Order\Status::COMPLETED->value)
                                            <div class="spinner-border spinner-border-sm {{ $stepData['color'] == 'indigo-style' ? '' : 'text-'.$stepData['color'] }}" 
                                                role="status"
                                                style="{{ $stepData['color'] == 'indigo-style' ? 'color: #563d7c !important;' : '' }}">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                         </div>
                         <div class="card-footer d-flex flex-wrap align-items-center justify-content-between bg-light-subtle gap-2">
                             <p class="border rounded mb-0 px-2 py-1 bg-body"><i
                                     class='bx bx-arrow-from-left align-middle fs-16'></i> {{__('global.estimated_delivery_date')}} :
                                 <span class="text-dark fw-medium">{{ $order->created_at->addDays(3)->translatedFormat('Y / m / D') }}</span></p>
                             <div>
                                 <a href="#!" class="btn btn-primary">Make As Ready To Ship</a>
                             </div>
                         </div>
                     </div>
                     <div class="card">
                         <div class="card-header">
                             <h4 class="card-title">Product</h4>
                         </div>
                         <div class="card-body">
                             <div class="table-responsive">
                                 <table class="table align-middle mb-0 table-hover table-centered">
                                     <thead class="bg-light-subtle border-bottom">
                                         <tr>
                                             <th>Product Name & Size</th>
                                             <th>Status</th>
                                             <th>Quantity</th>
                                             <th>Price</th>
                                             <th>Text</th>
                                             <th>Amount</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <tr>
                                             <td>
                                                 <div class="d-flex align-items-center gap-2">
                                                     <div
                                                         class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                         <img src="assets/images/product/p-1.png" alt=""
                                                             class="avatar-md">
                                                     </div>
                                                     <div>
                                                         <a href="#!" class="text-dark fw-medium fs-15">Men Black
                                                             Slim
                                                             Fit T-shirt</a>
                                                         <p class="text-muted mb-0 mt-1 fs-13"><span>Size : </span>M</p>
                                                     </div>
                                                 </div>

                                             </td>

                                             <td>
                                                 <span
                                                     class="badge bg-success-subtle text-success  px-2 py-1 fs-13">Ready</span>
                                             </td>
                                             <td> 1</td>
                                             <td>$80.00</td>
                                             <td> $3.00</td>
                                             <td>
                                                 $83.00
                                             </td>
                                         </tr>


                                         <tr>
                                             <td>
                                                 <div class="d-flex align-items-center gap-2">
                                                     <div
                                                         class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                         <img src="assets/images/product/p-5.png" alt=""
                                                             class="avatar-md">
                                                     </div>
                                                     <div>
                                                         <a href="#!" class="text-dark fw-medium fs-15">Dark
                                                             Green
                                                             Cargo Pent</a>
                                                         <p class="text-muted mb-0 mt-1 fs-13"><span>Size : </span>M
                                                         </p>
                                                     </div>
                                                 </div>

                                             </td>

                                             <td>
                                                 <span
                                                     class="badge bg-light text-dark  px-2 py-1 fs-13">Packaging</span>
                                             </td>
                                             <td> 3</td>
                                             <td>$330.00</td>
                                             <td> $4.00</td>
                                             <td>
                                                 $334.00
                                             </td>
                                         </tr>

                                         <tr>
                                             <td>
                                                 <div class="d-flex align-items-center gap-2">
                                                     <div
                                                         class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                         <img src="assets/images/product/p-8.png" alt=""
                                                             class="avatar-md">
                                                     </div>
                                                     <div>
                                                         <a href="#!" class="text-dark fw-medium fs-15">Men Dark
                                                             Brown Wallet</a>
                                                         <p class="text-muted mb-0 mt-1 fs-13"><span>Size : </span>S
                                                         </p>
                                                     </div>
                                                 </div>

                                             </td>

                                             <td>
                                                 <span
                                                     class="badge bg-success-subtle text-success  px-2 py-1 fs-13">Ready</span>
                                             </td>
                                             <td> 1</td>
                                             <td>$132.00</td>
                                             <td> $5.00</td>
                                             <td>
                                                 $137.00
                                             </td>
                                         </tr>

                                         <tr>
                                             <td>
                                                 <div class="d-flex align-items-center gap-2">
                                                     <div
                                                         class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                         <img src="assets/images/product/p-10.png" alt=""
                                                             class="avatar-md">
                                                     </div>
                                                     <div>
                                                         <a href="#!" class="text-dark fw-medium fs-15">Kid's
                                                             Yellow
                                                             T-shirt</a>
                                                         <p class="text-muted mb-0 mt-1 fs-13"><span>Size : </span>S
                                                         </p>
                                                     </div>
                                                 </div>

                                             </td>

                                             <td>
                                                 <span
                                                     class="badge bg-light text-dark  px-2 py-1 fs-13">Packaging</span>
                                             </td>
                                             <td> 2</td>
                                             <td>$220.00</td>
                                             <td> $3.00</td>
                                             <td>
                                                 $223.00
                                             </td>
                                         </tr>
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>
                     <div class="card">
                         <div class="card-header">
                             <h4 class="card-title">Order Timeline</h4>
                         </div>
                         <div class="card-body">
                             <div class="position-relative ms-2">
                                 <span class="position-absolute start-0  top-0 border border-dashed h-100"></span>
                                 <div class="position-relative ps-4">
                                     <div class="mb-4">
                                         <span
                                             class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle">
                                             <div class="spinner-border spinner-border-sm text-warning"
                                                 role="status">
                                                 <span class="visually-hidden">Loading...</span>
                                             </div>
                                         </span>
                                         <div
                                             class="ms-2 d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                             <div>
                                                 <h5 class="mb-1 text-dark fw-medium fs-15">The packing has been
                                                     started
                                                 </h5>
                                                 <p class="mb-0">Confirmed by Gaston Lapierre</p>
                                             </div>
                                             <p class="mb-0">April 23, 2024, 09:40 am</p>

                                         </div>
                                     </div>
                                 </div>
                                 <div class="position-relative ps-4">
                                     <div class="mb-4">
                                         <span
                                             class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                             <i class='bx bx-check-circle'></i>
                                         </span>
                                         <div
                                             class="ms-2 d-flex flex-wrap gap-2  align-items-center justify-content-between">
                                             <div>
                                                 <h5 class="mb-1 text-dark fw-medium fs-15">The Invoice has been sent
                                                     to
                                                     the customer</h5>
                                                 <p class="mb-2">Invoice email was sent to <a href="#!"
                                                         class="link-primary">hello@dundermuffilin.com</a></p>
                                                 <a href="#!" class="btn btn-light">Resend Invoice</a>
                                             </div>
                                             <p class="mb-0">April 23, 2024, 09:40 am</p>

                                         </div>
                                     </div>
                                 </div>
                                 <div class="position-relative ps-4">
                                     <div class="mb-4">
                                         <span
                                             class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                             <i class='bx bx-check-circle'></i>
                                         </span>
                                         <div
                                             class="ms-2 d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                             <div>
                                                 <h5 class="mb-1 text-dark fw-medium fs-15">The Invoice has been
                                                     created
                                                 </h5>
                                                 <p class="mb-2">Invoice created by Gaston Lapierre</p>
                                                 <a href="#!" class="btn btn-primary">Download Invoice</a>
                                             </div>
                                             <p class="mb-0">April 23, 2024, 09:40 am</p>

                                         </div>
                                     </div>
                                 </div>
                                 <div class="position-relative ps-4">
                                     <div class="mb-4">
                                         <span
                                             class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                             <i class='bx bx-check-circle'></i>
                                         </span>
                                         <div
                                             class="ms-2 d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                             <div>
                                                 <h5 class="mb-1 text-dark fw-medium fs-15">Order Payment</h5>
                                                 <p class="mb-2">Using Master Card</p>
                                                 <div class="d-flex align-items-center gap-2">
                                                     <p class="mb-1 text-dark fw-medium">Status :</p>
                                                     <span
                                                         class="badge bg-success-subtle text-success  px-2 py-1 fs-13">Paid</span>
                                                 </div>
                                             </div>
                                             <p class="mb-0">April 23, 2024, 09:40 am</p>

                                         </div>
                                     </div>
                                 </div>
                                 <div class="position-relative ps-4">
                                     <div class="mb-2">
                                         <span
                                             class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                             <i class='bx bx-check-circle'></i>
                                         </span>
                                         <div
                                             class="ms-2 d-flex flex-wrap gap-2  align-items-center justify-content-between">
                                             <div>
                                                 <h5 class="mb-2 text-dark fw-medium fs-15">4 Order conform by Gaston
                                                     Lapierre</h5>
                                                 <a href="#!"
                                                     class="badge bg-light text-dark fw-normal  px-2 py-1 fs-13">Order
                                                     1</a>
                                                 <a href="#!"
                                                     class="badge bg-light text-dark fw-normal  px-2 py-1 fs-13">Order
                                                     2</a>
                                                 <a href="#!"
                                                     class="badge bg-light text-dark fw-normal  px-2 py-1 fs-13">Order
                                                     3</a>
                                                 <a href="#!"
                                                     class="badge bg-light text-dark fw-normal  px-2 py-1 fs-13">Order
                                                     4</a>
                                             </div>
                                             <p class="mb-0">April 23, 2024, 09:40 am</p>

                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="card bg-light-subtle">
                         <div class="card-body">
                             <div class="row g-3 g-lg-0">
                                 <div class="col-lg-3 border-end">
                                     <div class="d-flex align-items-center gap-3 justify-content-between px-3">
                                         <div>
                                             <p class="text-dark fw-medium fs-16 mb-1">Vender</p>
                                             <p class="mb-0">Catpiller</p>
                                         </div>
                                         <div
                                             class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                             <iconify-icon icon="solar:shop-2-bold-duotone"
                                                 class="fs-35 text-primary"></iconify-icon>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-lg-3 border-end">
                                     <div class="d-flex align-items-center gap-3 justify-content-between px-3">
                                         <div>
                                             <p class="text-dark fw-medium fs-16 mb-1">Date</p>
                                             <p class="mb-0">April 23 , 2024</p>
                                         </div>
                                         <div
                                             class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                             <iconify-icon icon="solar:calendar-date-bold-duotone"
                                                 class="fs-35 text-primary"></iconify-icon>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-lg-3 border-end">
                                     <div class="d-flex align-items-center gap-3 justify-content-between px-3">
                                         <div>
                                             <p class="text-dark fw-medium fs-16 mb-1">Paid By</p>
                                             <p class="mb-0">Gaston Lapierre</p>
                                         </div>
                                         <div
                                             class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                             <iconify-icon icon="solar:user-circle-bold-duotone"
                                                 class="fs-35 text-primary"></iconify-icon>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-lg-3">
                                     <div class="d-flex align-items-center gap-3 justify-content-between px-3">
                                         <div>
                                             <p class="text-dark fw-medium fs-16 mb-1">Reference #IMEMO</p>
                                             <p class="mb-0">#{{$order->order_number}}</p>
                                         </div>
                                         <div
                                             class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                             <iconify-icon icon="solar:clipboard-text-bold-duotone"
                                                 class="fs-35 text-primary"></iconify-icon>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-xl-3 col-lg-4">
             <div class="card">
                 <div class="card-header">
                     <h4 class="card-title">
                        {{ __('global.order_summary') }}
                     </h4>
                 </div>
                 <div class="card-body">
                     <div class="table-responsive">
                         <table class="table mb-0">
                             <tbody>
                                 <tr>
                                     <td class="px-0">
                                         <p class="d-flex mb-0 align-items-center gap-1">
                                            <iconify-icon icon="solar:clipboard-text-broken"></iconify-icon> 
                                            {{ __('global.subtotal') }} : 
                                        </p>
                                     </td>
                                     <td class="text-end text-dark fw-medium px-0">
                                        {{format_currency($order->subtotal,'EGP')}}
                                    </td>
                                 </tr>
                                 <tr>
                                     <td class="px-0">
                                         <p class="d-flex text-red mb-0 align-items-center gap-1"><iconify-icon icon="solar:ticket-broken" class="align-middle"> </iconify-icon>
                                             {{ __('global.discount_total') }} : 
                                        </p>
                                     </td>
                                     <td class="text-end text-red fw-medium px-0">
                                        -{{format_currency($order->discount_total,'EGP')}}
                                    </td>
                                 </tr>
                                 <tr>
                                     <td class="px-0">
                                         <p class="d-flex mb-0 align-items-center gap-1">
                                            <iconify-icon icon="solar:kick-scooter-broken" class="align-middle"></iconify-icon>
                                             {{ __('global.shipping_total') }} : 
                                        </p>
                                     </td>
                                     <td class="text-end text-dark fw-medium px-0">
                                        {{format_currency($order->shipping_total,'EGP')}}
                                    </td>
                                 </tr>
                                 <tr>
                                     <td class="px-0">
                                         <p class="d-flex mb-0 align-items-center gap-1">
                                            <iconify-icon icon="solar:calculator-minimalistic-broken" class="align-middle"></iconify-icon>
                                             {{ __('global.tax_total') }} (15%) : 
                                        </p>
                                     </td>
                                     <td class="text-end text-dark fw-medium px-0">
                                        {{format_currency($order->tax_total,'EGP')}}
                                     </td>
                                 </tr>

                             </tbody>
                         </table>
                     </div>
                 </div>
                 <div class="card-footer d-flex align-items-center justify-content-between bg-light-subtle">
                     <div>
                         <p class="fw-medium text-dark mb-0">
                            {{ __('global.grand_total') }}
                         </p>
                     </div>
                     <div>
                         <p class="fw-medium text-dark mb-0">
                            {{format_currency($order->grand_total,'EGP')}}
                        </p>
                     </div>

                 </div>
             </div>
             {{-- <div class="card">
                 <div class="card-header">
                     <h4 class="card-title">Payment Information</h4>
                 </div>
                 <div class="card-body">
                     <div class="d-flex align-items-center gap-3 mb-3">
                         <div class="rounded-3 bg-light avatar d-flex align-items-center justify-content-center">
                             <img src="assets/images/card/mastercard.svg" alt="" class="avatar-sm">
                         </div>
                         <div>
                             <p class="mb-1 text-dark fw-medium">Master Card</p>
                             <p class="mb-0 text-dark">xxxx xxxx xxxx 7812</p>
                         </div>
                         <div class="ms-auto">
                             <iconify-icon icon="solar:check-circle-broken" class="fs-22 text-success"></iconify-icon>
                         </div>
                     </div>
                     <p class="text-dark mb-1 fw-medium">Transaction ID : <span class="text-muted fw-normal fs-13">
                             #IDN768139059</span></p>
                     <p class="text-dark mb-0 fw-medium">Card Holder Name : <span class="text-muted fw-normal fs-13">
                             Gaston Lapierre</span></p>

                 </div>
             </div> --}}
             <div class="card">
                 <div class="card-header">
                     <h4 class="card-title">
                        {{ __('global.customer_information') }}
                     </h4>
                 </div>
                 <div class="card-body">
                     <div class="d-flex align-items-center gap-2">
                         <img src="{{$order->user->getFirstMediaUrl('avatar')}}" loading="lazy" alt="{{$order->user->profile->first_name .' '.$order->user->profile->last_name}}"
                             class="avatar rounded-3 border border-light border-3">
                         <div>
                             <p class="mb-1">
                                {{$order->user->profile->first_name .' '.$order->user->profile->last_name}}
                             </p>
                             <a href="#!" class="link-primary fw-medium">
                                {{$order->user->email}}
                            </a>
                         </div>
                     </div>
                     <div class="d-flex justify-content-between mt-3">
                         <h5 class="">
                            {{ __('global.phone') }}
                        </h5>
                       
                     </div>
                     <p class="mb-1">
                        {{$order->user->phone}}
                     </p>

                     <div class="d-flex justify-content-between mt-3">
                         <h5 class="">
                            {{ __('global.shipping_address') }}
                         </h5>

                     </div>

                     <div>
                         <p class="mb-1">Wilson's Jewelers LTD</p>
                         <p class="mb-1">1344 Hershell Hollow Road ,</p>
                         <p class="mb-1">Tukwila, WA 98168 ,</p>
                         <p class="mb-1">United States</p>
                         <p class="">(723) 732-760-5760</p>
                     </div>

                     <div class="d-flex justify-content-between mt-3">
                         <h5 class="">
                            {{ __('global.billing_address') }}
                         </h5>
                         
                     </div>

                     <p class="mb-1">Same as shipping address</p>
                 </div>
             </div>

             {{-- <div class="card">
                 <div class="card-body">
                     <div class="mapouter">
                         <div class="gmap_canvas"><iframe class="gmap_iframe rounded" width="100%"
                                 style="height: 418px;" frameborder="0" scrolling="no" marginheight="0"
                                 marginwidth="0"
                                 src="https://maps.google.com/maps?width=1980&amp;height=400&amp;hl=en&amp;q=University%20of%20Oxford&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                         </div>
                     </div>
                 </div>
             </div> --}}
         </div>
     </div>
     
     @push('javascript')
         <script src="{{ asset('assets/js/dashboard/pages/order/order.js') }}"></script>
         <script src="{{ asset('assets/js/dashboard/pages/jquery/order/order.js') }}"></script>
     @endpush
 </x-dashboard.layout>
