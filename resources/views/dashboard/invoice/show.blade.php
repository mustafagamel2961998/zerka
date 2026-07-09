<x-dashboard.layout title="{{ $invoice->invoice_number }}">

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">

                    {{-- Header: Logo & Invoice meta --}}
                    <div class="clearfix pb-3 border-bottom p-lg-3 p-2 m-n2 rounded position-relative">
                        <div class="float-sm-start">
                            <div class="auth-logo">
                                <img class="logo-dark me-1 object-fit-cover" src="{{config('app_settings')->getFirstMediaUrl('logo','optimized') }}" 
                                alt=" {{ config('app_settings.currentTranslation.name') }}" width="100" height="100" />
                            </div>
                            <div class="mt-4">
                                <h4 class="fw-bold text-dark">
                                    {{ config('app_settings.currentTranslation.name') }}
                                </h4>
                                <address class="mt-3 mb-0 text-muted">
                                    <abbr title="Email">
                                    {{ __('global.email') }} :
                                    </abbr>
                                     {{ config('app_settings.email') }}
                                    <br>
                                    <abbr title="Phone">
                                        {{ __('global.phone') }}:</abbr> 
                                        {{ config('app_settings.phone') }}
                                </address>
                            </div>
                        </div>
                        <div class="float-sm-end">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="p-0 pe-5 py-1"><p class="mb-0 text-dark fw-semibold">{{ __('global.invoice_number') }} :</p></td>
                                            <td class="text-end text-dark fw-semibold px-0 py-1">#{{ $invoice->invoice_number }}</td>
                                        </tr>
                                        <tr>
                                            <td class="p-0 pe-5 py-1"><p class="mb-0">{{ __('global.date') }} :</p></td>
                                            <td class="text-end text-dark fw-medium px-0 py-1">{{ $invoice->created_at->format('d M Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="p-0 pe-5 py-1"><p class="mb-0">{{ __('global.order_number') }} :</p></td>
                                            <td class="text-end text-dark fw-medium px-0 py-1">#{{ $invoice->order->order_number }}</td>
                                        </tr>
                                        <tr>
                                            <td class="p-0 pe-5 py-1"><p class="mb-0">{{ __('global.grand_total') }} :</p></td>
                                            <td class="text-end text-dark fw-medium px-0 py-1">{{ format_currency($invoice->grand_total) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="p-0 pe-5 py-1"><p class="mb-0">{{ __('global.payment_status') }} :</p></td>
                                            <td class="text-end px-0 py-1">
                                                @php
                                                    $paymentStatus = $invoice->order->payment_status;
                                                @endphp
                                                <span class="badge px-2 py-1 fs-13 {{ $paymentStatus->value === 'paid' ? 'bg-dark text-white' : 'bg-secondary text-white' }}">
                                                    {{ ucfirst($paymentStatus->value) }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Issue From / Issue For --}}
                    <div class="clearfix pb-3 mt-4">
                       
                        <div class="float-sm-end">
                            <h4 class="card-title">
                                Issue For :
                            </h4>
                            <div class="mt-3">
                                @php
                                    $profile = $invoice->user->profile;
                                    $address = $invoice->order->address;
                                @endphp
                                <h4>{{ $profile?->full_name ?? $invoice->user->email }}</h4>
                                @if($address)
                                    <p class="mb-2">
                                        <p>{{ $address->street_details  }}</p>
                                        <p>{{ $address->city}},{{ $address->country }}</p>
                                    </p>
                                    <p class="mb-2">
                                        {{ $address->phone ?? $invoice->user->phone }}
                                    </p>
                                @endif
                                <p class="mb-2">
                                    {{ $invoice->user->email }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Items Table --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive table-borderless text-nowrap table-centered">
                                <table class="table mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="border-0 py-2">
                                                {{ __('global.product_name') }}
                                            </th>
                                            <th class="border-0 py-2">
                                                {{ __('global.quantity') }}
                                            </th>
                                            <th class="border-0 py-2">
                                                {{ __('global.price') }}
                                            </th>
                                            <th class="text-end border-0 py-2">
                                                {{ __('global.total') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($invoice->order->items as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="rounded bg-light avatar d-flex align-items-center justify-content-center">
                                                            <img src="{{ $item->product?->getFirstMediaUrl('images') ?: asset('assets/images/product/placeholder.png') }}" alt="" class="avatar">
                                                        </div>
                                                        <div>
                                                            <span class="text-dark fw-medium fs-15">{{ $item->product->name ?? 'N/A' }}</span>
                                                            @foreach ($item->attributes as $key => $attribute)
                                                                <p class="text-muted mb-0 mt-1 fs-13">
                                                                    <span class="fw-bold text-dark">
                                                                        {{ __('global.'.$key )}} :
                                                                    </span>
                                                                    @if($key == 'color')
                                                                        <span class="d-inline-block rounded-circle border"
                                                                                style="width:18px;height:18px;background-color: {{ $attribute }};">
                                                                        </span>
                                                                        @else
                                                                        {{ $attribute }}
                                                                    @endif
                                                                </p>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ format_currency($item->price) }}</td>
                                                <td class="text-end">{{ format_currency($item->total) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Totals --}}
                    <div class="row justify-content-end">
                        <div class="col-lg-5 col-6">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="text-end p-0 pe-5 py-2"><p class="mb-0">
                                                  <iconify-icon icon="solar:clipboard-text-broken"></iconify-icon>
                                                {{ __('global.subtotal')}} :</p></td>
                                            <td class="text-end text-dark fw-medium py-2">{{ format_currency($invoice->subtotal,current_currency_code()) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-end p-0 pe-5 py-2"><p class="mb-0">
                                                <iconify-icon
                                                    icon="solar:ticket-broken" class="align-middle"> </iconify-icon>
                                                    {{ __('global.discount_total')}} :</p></td>
                                            <td class="text-end text-dark fw-medium py-2">-{{ format_currency($invoice->discount_total,current_currency_code()) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-end p-0 pe-5 py-2"><p class="mb-0">
                                                 <iconify-icon icon="solar:kick-scooter-broken"
                                                    class="align-middle"></iconify-icon>
                                                    {{ __('global.shipping_total')}} :</p></td>
                                            <td class="text-end text-dark fw-medium py-2">{{ format_currency($invoice->shipping_total,current_currency_code()) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-end p-0 pe-5 py-2"><p class="mb-0">
                                                  <iconify-icon icon="solar:calculator-minimalistic-broken"
                                                    class="align-middle"></iconify-icon>
                                                    {{ __('global.tax_total')}} :</p></td>
                                            <td class="text-end text-dark fw-medium py-2">{{ format_currency($invoice->tax_total,current_currency_code()) }}</td>
                                        </tr>
                                        <tr class="border-top">
                                            <td class="text-end p-0 pe-5 py-2"><p class="mb-0 text-dark fw-semibold">
                                                {{ __('global.grand_total')}} :</p></td>
                                            <td class="text-end text-dark fw-semibold py-2">{{ format_currency($invoice->grand_total,current_currency_code()) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Note --}}
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="alert alert-dark alert-icon p-2" role="alert">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm rounded bg-dark d-flex justify-content-center align-items-center fs-18 me-2 flex-shrink-0">
                                        <i class="bx bx-info-circle text-white"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        {{__('global.invoice_desc',['siteName' => config('app_settings.currentTranslation.name')])}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="mt-3 mb-1">
                        <div class="text-end d-print-none">
                            <a href="javascript:window.print()" class="btn btn-dark width-xl">Print</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-dashboard.layout>