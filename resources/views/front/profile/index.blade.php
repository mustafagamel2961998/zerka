<x-front.layout title="{{ auth()->user()->profile->full_name }}">
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/css/front/pages/profile/profile.css') }}">
    @endpush

    <div class="container py-5">
        <!-- هيدر الصفحة والترحيب بالعميل -->
        <div class="mb-5 border-bottom border-light-subtle pb-4">
            <h3 class="fw-bold text-uppercase tracking-wider fs-4 mb-1">{{ __('front.dashboard') }}</h3>
            <p class="text-muted small mb-0">{{ __('front.welcome_back') }} <span class="fw-semibold text-dark">{{ auth()->user()->profile->full_name }}</span></p>
        </div>

        <div class="row g-4">
            <!-- القائمة الجانبية للتنقل (Tabs Nav) -->
            <div class="col-md-3">
                <div class="nav flex-column nav-pills border rounded-0 p-2 bg-light-subtle gap-1" id="profileTabs" role="tablist" aria-orientation="vertical">
                    
                    <button class="nav-link text-start rounded-0 fw-semibold active py-2.5 fs-7 text-dark shadow-none" id="orders-tab" data-bs-toggle="pill" data-bs-target="#orders-pane" type="button" role="tab" aria-controls="orders-pane" aria-selected="true">
                        <i class="bi bi-box-seam me-2"></i> {{ __('front.my_orders') }}
                    </button>
                    
                    <button class="nav-link text-start rounded-0 fw-semibold py-2.5 fs-7 text-dark shadow-none" id="addresses-tab" data-bs-toggle="pill" data-bs-target="#addresses-pane" type="button" role="tab" aria-controls="addresses-pane" aria-selected="false">
                        <i class="bi bi-geo-alt me-2"></i> {{ __('front.my_addresses') }}
                    </button>
                    
                    <button class="nav-link text-start rounded-0 fw-semibold py-2.5 fs-7 text-dark shadow-none" id="account-tab" data-bs-toggle="pill" data-bs-target="#account-pane" type="button" role="tab" aria-controls="account-pane" aria-selected="false">
                        <i class="bi bi-person me-2"></i> {{ __('front.account_details') }}
                    </button>

                    <a href="#" class="nav-link text-start rounded-0 fw-semibold py-2.5 fs-7 text-danger border-top border-light-subtle mt-2">
                        <i class="bi bi-box-arrow-left me-2"></i> {{ __('front.logout') }}
                    </a>
                </div>
            </div>

            <!-- محتوى التبويبات (Tabs Content) -->
            <div class="col-md-9">
                <div class="tab-content" id="profileTabsContent">
                    
                    <!-- التبويب الأول: قائمة الطلبات -->
                    <div class="tab-pane fade show active" id="orders-pane" role="tabpanel" aria-labelledby="orders-tab" tabindex="0">
                        <h5 class="fw-bold text-uppercase tracking-wider fs-6 mb-4">{{ __('front.order_history') }}</h5>
                        
                        <!-- جدول الطلبات المتجاوب -->
                        <div class="table-responsive border rounded-0 bg-white">
                            <table class="table table-borderless align-middle mb-0 text-center small">
                                <thead class="table-light border-bottom border-light-subtle">
                                    <tr class="text-uppercase tracking-wide text-muted fw-bold" style="font-size: 0.65rem;">
                                        <th class="py-3"># {{ __('front.order_no') }}</th>
                                        <th class="py-3">{{ __('front.date') }}</th>
                                        <th class="py-3">{{ __('front.status') }}</th>
                                        <th class="py-3">{{ __('front.total') }}</th>
                                        <th class="py-3">
                                             {{ __('front.view_details') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr class="border-bottom border-light-subtle">
                                            <td class="py-3 fw-bold">#{{$order->order_number}}</td>
                                            <td class="text-muted">{{$order->created_at->translatedFormat('Y-m-d')}}</td>
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
                                                            {{__('global.delivered')}}
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
                                            <td class="fw-semibold">
                                                {{ format_currency($order->grand_total,current_currency_code()) }}
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-dark rounded-0 px-2.5 py-1" style="font-size: 0.65rem;">
                                                    {{ __('front.view_details') }}
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        
                                    @endforelse
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- التبويب الثاني: إدارة العناوين -->
                    <div class="tab-pane fade" id="addresses-pane" role="tabpanel" aria-labelledby="addresses-tab" tabindex="0">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold text-uppercase tracking-wider fs-6 mb-0">{{ __('front.saved_addresses') }}</h5>
                            <button type="button" class="btn btn-sm btn-dark rounded-0 px-3 small" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                                <i class="bi bi-plus-lg me-1"></i> {{ __('front.add_new_address') }}
                            </button>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="border p-3 rounded-0 bg-light-subtle position-relative">
                                    <span class="badge bg-dark rounded-0 position-absolute top-0 end-0 m-3 px-1.5 py-0.5" style="font-size: 0.6rem;">{{ __('front.default') }}</span>
                                    <h6 class="fw-bold small mb-2">{{ __('front.home') }}</h6>
                                    <p class="text-muted small mb-0">حدائق أكتوبر، عمارة 14، شقة 5</p>
                                    <p class="text-muted small mb-3">الجيزة، مصر</p>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm p-0 text-muted border-0 bg-transparent small text-decoration-underline" style="font-size: 0.7rem;">{{ __('front.edit') }}</button>
                                        <span class="text-light-subtle">|</span>
                                        <button class="btn btn-sm p-0 text-danger border-0 bg-transparent small text-decoration-underline" style="font-size: 0.7rem;">{{ __('front.delete') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- التبويب الثالث: تعديل البيانات الشخصية -->
                    <div class="tab-pane fade" id="account-pane" role="tabpanel" aria-labelledby="account-tab" tabindex="0">
                        <h5 class="fw-bold text-uppercase tracking-wider fs-6 mb-4">{{ __('front.account_information') }}</h5>
                        
                        <form action="#" method="POST" id="updateProfileForm">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted text-uppercase">{{ __('front.full_name') }}</label>
                                    <input type="text" class="form-control rounded-0 shadow-none form-control-sm" value="{{ auth()->user()->name }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted text-uppercase">{{ __('front.email_address') }}</label>
                                    <input type="email" class="form-control rounded-0 shadow-none form-control-sm" value="{{ auth()->user()->email }}" required>
                                </div>
                                <div class="col-md-10 mt-4">
                                    <h6 class="fw-bold text-dark text-uppercase small tracking-wide border-bottom pb-2 mb-3">{{ __('front.change_password') }}</h6>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted text-uppercase">{{ __('front.current_password') }}</label>
                                    <input type="password" class="form-control rounded-0 shadow-none form-control-sm">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted text-uppercase">{{ __('front.new_password') }}</label>
                                    <input type="password" class="form-control rounded-0 shadow-none form-control-sm">
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-dark rounded-0 text-uppercase fw-bold px-4 py-2 fs-7">
                                        {{ __('front.save_changes') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- الـ Modal المعتمد لإضافة عنوان جديد -->
    <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0 border-dark">
                <div class="modal-header border-bottom-0 py-3">
                    <h5 class="modal-title fw-bold text-uppercase fs-6 tracking-wide" id="addAddressModalLabel">
                        {{ __('front.add_new_address') }}
                    </h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="addAddressForm">
                    @csrf
                    <div class="modal-body py-0">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">{{ __('front.address_title') }}</label>
                            <input type="text" class="form-control rounded-0 shadow-none form-control-sm" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">{{ __('front.governorate') }}</label>
                            <input type="text" class="form-control rounded-0 shadow-none form-control-sm" name="governorate" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">{{ __('front.address_details') }}</label>
                            <textarea class="form-control rounded-0 shadow-none small" rows="3" name="details" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0 pb-3">
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-0 px-3" data-bs-dismiss="modal">{{ __('front.cancel') }}</button>
                        <button type="submit" class="btn btn-sm btn-dark rounded-0 px-4">{{ __('front.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
        <script src="{{ asset('assets/js/front/pages/profile/profile.js') }}"></script>
    @endpush
</x-front.layout>