<div class="position-relative">
    {{-- table loader  --}}
    <div class="table_loader" >
        {{awtTrans('جاري التحميل')}}
    </div>
    {{-- table loader  --}}
    
    {{-- table content --}}
    <table class="table " id="tab">
        <thead>
            <tr>
                <th>
                    <label class="container-checkbox">
                        <input type="checkbox" value="value1" name="name1" id="checkedAll">
                        <span class="checkmark"></span>
                    </label>
                </th>
                <th>{{awtTrans('رقم الطلب')}}</th>
                <th>{{awtTrans('اسم العميل')}}</th>
                <th>{{awtTrans('سعر الطلب')}}</th>
                <th>{{awtTrans('حاله الطلب')}}</th>
                <th>{{awtTrans('حاله الدفع')}}</th>
                <th>{{awtTrans('نوع الدفع')}}</th>
                <th>{{awtTrans('التحكم')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr class="delete_row">
                    <td class="text-center">
                        <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $order->id }}">
                        <span class="checkmark"></span>
                        </label>
                    </td>
                    <td>{{ $order->order_num }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->total_price }}</td>
                    <td>
                        @if ($order->status == 'current')
                        <span class="btn btn-sm round btn-outline-danger">
                            {{ awtTrans('قيد التنفيذ') }} <i class="la la-close font-medium-2"></i>
                        </span>
                            @elseif ($order->status == 'finished')
                                <span class="btn btn-sm round btn-outline-danger">
                            {{ awtTrans('مكتمل') }} <i class="la la-close font-medium-2"></i>
                        </span>

                            @else
                        <span class="btn btn-sm round btn-outline-success">
                            {{ awtTrans('ملغي') }} <i class="la la-check font-medium-2"></i>
                        </span>
                        @endif
                    </td>
                    <td>
                        @if ($order->pay_status == 'done')
                            <span class="btn btn-sm round btn-outline-danger">
                            {{ awtTrans('تم الدفع') }} <i class="la la-close font-medium-2"></i>
                        </span>
                        @else
                            <span class="btn btn-sm round btn-outline-success">
                            {{ awtTrans('لم يتم الدفع') }} <i class="la la-check font-medium-2"></i>
                        </span>
                        @endif
                    </td>

                    <td>{{ $order->getPaidType() }}</td>

                    <td class="product-action"> 
                        <span class="text-primary"><a href="{{ route('admin.orders.show', ['id' => $order->id]) }}"><i class="feather icon-eye"></i></a></span>
                        <span class="delete-row text-danger" data-url="{{ url('admin/orders/' . $order->id) }}"><i class="feather icon-trash"></i></span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($orders->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{awtTrans('لا يوجد نتائج مطابقة')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($orders->count() > 0 && $orders instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$orders->links()}}
    </div>
@endif
{{-- pagination  links div --}}

