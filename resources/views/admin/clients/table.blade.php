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
                <th>{{ awtTrans('الصورة') }}</th>
                <th>{{ awtTrans('الاسم') }}</th>
                <th>{{ awtTrans('البريد الالكتروني') }}</th>
                <th>{{ awtTrans('رقم الهاتف') }}</th>
                <th>{{ awtTrans('حالة الحظر') }}</th>
                <th>{{ awtTrans('التفعيل') }}</th>
                <th>{{ awtTrans('التحكم') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr class="delete_row">
                <td class="text-center">
                    <label class="container-checkbox">
                    <input type="checkbox" class="checkSingle" id="{{ $row->id }}">
                    <span class="checkmark"></span>
                    </label>
                </td>
                <td><img src="{{$row->image}}" width="50px" height="50px" alt=""></td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->phone }}</td>
                <td>
                    @if ($row->is_blocked)
                    <span class="btn btn-sm round btn-outline-danger">
                        {{ awtTrans('محظور') }} <i class="la la-close font-medium-2"></i>
                    </span>
                    @else
                    <span class="btn btn-sm round btn-outline-success">
                        {{ awtTrans('غير محظور') }} <i class="la la-check font-medium-2"></i>
                    </span>
                    @endif
                </td>
                <td>
                    @if ($row->active)
                    <span class="btn btn-sm round btn-outline-success">
                        {{ awtTrans('مفعل') }} <i class="la la-close font-medium-2"></i>
                    </span>
                    @else
                    <span class="btn btn-sm round btn-outline-danger">
                        {{ awtTrans('غير مفعل') }} <i class="la la-check font-medium-2"></i>
                    </span>
                    @endif
                </td>
                <td class="product-action">
                    <span class="text-primary"><a
                        href="{{ route('admin.clients.show', ['id' => $row->id]) }}"><i
                        class="feather icon-eye"></i></a></span>
                    <span class="action-edit text-primary"><a
                        href="{{ route('admin.clients.edit', ['id' => $row->id]) }}"><i
                        class="feather icon-edit"></i></a></span>
{{--                    <span data-toggle="modal" data-target="#notify" class="text-info notify"--}}
{{--                        data-id="{{ $row->id }}"--}}
{{--                        data-url="{{ url('admins/clients/notify') }}"><i--}}
{{--                        class="feather icon-bell"></i></span>--}}
{{--                    <span data-toggle="modal" data-target="#mail" class="text-info mail"--}}
{{--                        data-id="{{ $row->id }}"--}}
{{--                        data-url="{{ url('admins/clients/notify') }}"><i--}}
{{--                        class="feather icon-mail"></i></span>--}}
                    <span class="delete-row text-danger"
                        data-url="{{ url('admin/clients/' . $row->id) }}"><i
                        class="feather icon-trash"></i></span>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($rows->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{awtTrans('لا يوجد نتائج مطابقة')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($rows->count() > 0 && $rows instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$rows->links()}}
    </div>
@endif
{{-- pagination  links div --}}

