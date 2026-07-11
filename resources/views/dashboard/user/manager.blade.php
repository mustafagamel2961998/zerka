<x-dashboard.layout title="{{ __('dashboard.managers') }}">
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard/pages/user/user.css') }}">
    @endpush
    
    <div class="row">
        <!-- إحصائيات المستخدمين -->
        {{-- <x-dashboard.partial.user.statistics/> --}}
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center gap-1">
                    <h4 class="card-title flex-grow-1">
                        {{ __('global.table-title', ['name' => __('dashboard.' . request()->segment(3))]) }}
                    </h4>

                </div>
                
                @if($users->isEmpty())
                    <div class="card p-5 text-center border-0 shadow-sm">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="bg-light-subtle rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <iconify-icon icon="solar:users-group-two-rounded-broken" class="text-muted" style="font-size: 45px;"></iconify-icon>
                            </div>
                            <h5 class="text-dark fw-semibold mb-1">{{ __('global.no_data_found') }}</h5>
                            <p class="text-muted mb-0 fs-13">{{ __('global.no_records_have_been_added_to_this_table_yet') }}</p>
                          
                        </div>
                    </div>
                @else
                    <div class="p-1">
                        @include('dashboard.user.data-list', ['users' => $users])
                    </div>
                    <div class="card-footer border-top">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
 
    @push('javascript')
        <script src="{{ asset('assets/js/dashboard/pages/user/user.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/pages/jquery/user/user.js') }}"></script>
    @endpush
</x-dashboard.layout>

{{-- delete modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <div class="modal-body text-center p-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-danger-subtle text-danger rounded-circle mb-3" style="width: 64px; height: 64px;">
                    <iconify-icon icon="solar:danger-triangle-bold-duotone" style="font-size: 36px;"></iconify-icon>
                </div>

                <h4 class="text-dark fw-bold mb-2">{{ __('global.delete_confirmation') }}</h4>
                
                <p class="text-muted fs-15 mb-3">
                    {{ __('global.delete_warning_title', ['name' => __('dashboard.user')]) }}
                    <strong id="name-span" class="text-dark fw-semibold d-block mt-1 fs-16"></strong>
                </p>

                <p class="text-secondary small mb-0 fs-12">
                    <iconify-icon icon="solar:lock-password-broken" class="align-middle me-1"></iconify-icon>
                    {{ __('global.cannot_undo') }}
                </p>
            </div>

            <div class="modal-footer border-0 bg-light-subtle d-flex justify-content-center gap-2 pb-4 pt-0 px-4">
                <button type="button" class="btn btn-light fw-medium px-4" data-bs-dismiss="modal" style="border-radius: 8px;">
                    {{ __('global.cancel') }}
                </button>
                
                <form id="modal-delete-form" action="" method="POST" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger fw-medium px-4" style="border-radius: 8px;">
                        {{ __('global.confirm_delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>