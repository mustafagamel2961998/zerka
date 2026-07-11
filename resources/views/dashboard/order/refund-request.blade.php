<x-dashboard.layout title="{{ __('dashboard.refund_request') }}">

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title">
                            {{ __('global.table-title', ['name' => __('dashboard.refund_request')]) }}
                        </h4>
                    </div>
                    
                </div>

                @if($refund_requests->isEmpty())
                    <div class="card p-5 text-center border-0 shadow-sm">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="bg-light-subtle rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <iconify-icon icon="solar:folder-empty-broken" class="text-muted" style="font-size: 45px;"></iconify-icon>
                            </div>
                            <h5 class="text-dark fw-semibold mb-1">{{ __('global.no_data_found') }}</h5>
                            <p class="text-muted mb-0 fs-13">{{ __('global.no_records_have_been_added_to_this_table_yet') }}</p>
                        </div>
                    </div>
                @else
                    <div class="p-1">
                        @include('dashboard.order.refund-data-list', [
                            'refunds' => $refund_requests,
                        ])
                    </div>
                    <div class="card-footer border-top">
                        {{ $refund_requests->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Reject Reason Modal --}}
    <div class="modal fade" id="rejectRefundModal" tabindex="-1" aria-labelledby="rejectRefundModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
                <div class="modal-body p-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-danger-subtle text-danger rounded-circle mb-3"
                        style="width: 56px; height: 56px;">
                        <iconify-icon icon="solar:close-circle-broken" style="font-size: 30px;"></iconify-icon>
                    </div>
                    <h5 class="text-dark fw-bold mb-2">{{ __('global.reject_refund') }}</h5>
                    <p class="text-muted fs-14 mb-3">{{ __('global.reject_refund_desc') }}</p>

                    <form id="reject-refund-form">
                        @csrf
                        <input type="hidden" name="refund_id" id="reject-refund-id">
                        <textarea name="reject_reason" id="reject-reason" class="form-control" rows="3"
                            placeholder="{{ __('global.reject_reason_placeholder') }}" required></textarea>
                    </form>
                </div>
                <div class="modal-footer border-0 bg-light-subtle d-flex justify-content-center gap-2 pb-4 pt-0 px-4">
                    <button type="button" class="btn btn-light fw-medium px-4" data-bs-dismiss="modal" style="border-radius: 8px;">
                        {{ __('global.cancel') }}
                    </button>
                    <button type="button" id="confirm-reject-refund-btn" class="btn btn-danger fw-medium px-4" style="border-radius: 8px;">
                        {{ __('global.confirm') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('javascript')
        <script src="{{ asset('assets/js/dashboard/pages/refund/refund.js') }}"></script>
    @endpush
</x-dashboard.layout>