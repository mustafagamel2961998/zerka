   <div id="my-invoice-html-table" class="table-responsive">
       <table class="table align-middle mb-0 table-hover table-centered">
           <thead class="bg-light-subtle">
               <tr>
                   <th>
                    {{ __('global.invoice_number') }}
                   </th>
                   <th>
                    {{ __('global.customer') }}
                   </th>
                   <th>
                    {{ __('global.created_at') }}
                   </th>
                   <th>
                    {{ __('global.grand_total') }}
                   </th>
                   <th>
                    {{ __('global.payment_method') }}
                   </th>
                   <th>
                    {{ __('global.status') }}
                   </th>
                   <th>
                    {{__('global.action')}}
                   </th>
               </tr>
           </thead>
           <tbody>
            @foreach ($invoices as $invoice)
               <tr>
                   <td>
                    <a href="javascript: void(0);" class="text-body">
                        #{{$invoice->invoice_number}}
                    </a> 
                  </td>
                   <td>
                    <img src="{{$invoice->order->user->getFirstMediaUrl('avatar','thumb')}}" class="avatar-sm rounded-circle me-2" alt="{{$invoice->order->user->profile->full_name}}">
                       {{$invoice->order->user->profile->full_name}}
                    </td>
                   <td> 
                    {{$invoice->order->created_at->format('Y-m-d')}}
                   </td>
                   <td> 
                       {{ format_currency($invoice->grand_total,current_currency_code()) }}
                   </td>
                   <td> 
                          @switch($invoice->order->payment_status?->value) 
                            @case('paid')
                                <span class="badge border border-success text-success px-2 py-1 fs-13">
                                    {{__('global.paid')}}
                                </span>
                                @break
                            @case('failed')
                                <span class="badge border border-danger text-danger px-2 py-1 fs-13">
                                    {{__('global.failed')}}
                                </span>
                                @break
                                
                            @default
                                <span class="badge border border-secondary text-secondary px-2 py-1 fs-13">
                                    {{__('global.pending')}}
                                </span>
                           @endswitch
                   </td>
                   <td> 
                      @switch($invoice->order->status?->value)
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
                 <td>
                    @can('manage-invoices')
                      <a href="{{route('dashboard.v1.invoices.show', $invoice->id)}}" class="btn btn-light btn-sm">
                            <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                      </a>
                       @endcan
                 </td>
               </tr>
            @endforeach

            
           </tbody>
       </table>
   </div>
   <div id="table-invoice-gridjs"></div>
