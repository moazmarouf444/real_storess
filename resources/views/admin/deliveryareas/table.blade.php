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
                <th>{{awtTrans('الاسم')}}</th>
                <th>{{awtTrans('السعر')}}</th>
                <th>{{awtTrans('التحكم')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deliveryareas as $deliveryarea)
                <tr class="delete_row">
                    <td class="text-center">
                        <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $deliveryarea->id }}">
                        <span class="checkmark"></span>
                        </label>
                    </td>
                    <td>{{ $deliveryarea->name }}</td>
                    <td>{{ $deliveryarea->price }}</td>

                    <td class="product-action"> 
                        <span class="text-primary"><a href="{{ route('admin.deliveryareas.show', ['id' => $deliveryarea->id]) }}"><i class="feather icon-eye"></i></a></span>
                        <span class="action-edit text-primary"><a href="{{ route('admin.deliveryareas.edit', ['id' => $deliveryarea->id]) }}"><i class="feather icon-edit"></i></a></span>
                        <span class="delete-row text-danger" data-url="{{ url('admin/deliveryareas/' . $deliveryarea->id) }}"><i class="feather icon-trash"></i></span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($deliveryareas->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{awtTrans('لا يوجد نتائج مطابقة')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($deliveryareas->count() > 0 && $deliveryareas instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$deliveryareas->links()}}
    </div>
@endif
{{-- pagination  links div --}}

