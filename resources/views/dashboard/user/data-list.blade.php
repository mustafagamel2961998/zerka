<div class="table-responsive">
    <table id="my-user-html-table" class="table align-middle mb-0 table-hover table-centered">
        <thead class="bg-light-subtle">
            <tr>
                <th>{{ __('global.number') }}</th>
                <th>{{ __('global.avatar') ?? __('global.image') }}</th>
                <th>{{ __('global.full_name') ?? __('global.name') }}</th>
                <th>{{ __('global.email') }}</th>
                <th>{{ __('global.phone') }}</th>
                <th>{{ __('global.country') }}</th>
                <th>{{ __('global.city') }}</th>
                <th>{{ __('global.role') }}</th>
                <th>{{ __('global.created_at') }}</th>
                <th>{{ __('global.status') }}</th>
                <th>{{ __('global.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <!-- استخدام كولكشن avatar ميديا المحددة في الموديل -->
                        <x-dashboard.partial.image 
                            :src="$user->getFirstMediaUrl('avatar', 'thumb')" 
                            :class="'table-image cursor-pointer rounded-circle'" 
                            :alt="$user->profile?->full_name" />
                    </td>
                    <td class="fw-medium">
                        <!-- استخدام الـ Accessor المجهز في موديل الـ Profile -->
                        {{ $user->profile->full_name}}
                    </td>
                    <td>
                        <a href="mailto:{{ $user->email }}" class="text-body">{{ $user->email }}</a>
                    </td>
                    <td>
                        <span class="text-muted">{{ $user->phone}}</span>
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border">
                            <iconify-icon icon="solar:earth-broken" class="align-middle me-1 text-muted"></iconify-icon>
                            {{ $user->country->currentTranslation->name }}
                        </span>
                    </td>
                        <td>
                        <span class="badge bg-light text-dark border">
                            {{ $user->profile->city->currentTranslation->name }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-soft-secondary text-secondary text-uppercase">
                            {{ $user->role}}
                        </span>
                    </td>
                    <td>
                        {{ $user->created_at->translatedFormat('Y-m-d') }} /
                        <small class="text-muted">({{ $user->created_at->diffForHumans() }})</small>
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <!-- فحص الـ Enum المصبوب داخل الـ Casts كـ Status -->
                            <input class="form-check-input text-success" type="checkbox" name="status" role="switch" @checked($user->status->value === 'active')>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('dashboard.v1.users.edit', $user->id) }}" class="btn btn-soft-primary btn-sm">
                                <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon>
                            </a>
                           
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div id="table-user-gridjs"></div>