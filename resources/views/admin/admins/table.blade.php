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
                  <th>{{ awtTrans('التاريخ') }}</th>
                  <th>{{ awtTrans('الصوره') }}</th>
                  <th>{{ awtTrans('الاسم') }}</th>
                  <th>{{ awtTrans('البريد الالكتروني') }}</th>
                  <th>{{ awtTrans('رقم الهاتف') }}</th>
                  <th>{{ awtTrans('الحالة') }}</th>
                  <th>{{ awtTrans('التحكم') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
                <tr class="delete_row">
                <td class="text-center">
                    @if ($admin->id != 1 && auth()->id() != $admin->id)
                    <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $admin->id }}">
                        <span class="checkmark"></span>
                    </label>
                    @else
                    *
                    @endif
                </td>
                <td>{{ $admin->created_at->format('d/m/Y') }}</td>
                <td>
                    <img src="{{ asset($admin->avatar) }}" width="50px" height="50px"
                        alt="avatar">
                </td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->phone }}</td>
                <td>
                    @if ($admin->is_blocked)
                    <span class="btn btn-sm btn-outline-danger">
                        {{ awtTrans('محظور') }}
                        <i class="la la-close font-medium-2"></i>
                    </span>
                    @else
                    <span class="btn btn-sm btn-outline-success">
                        {{ awtTrans('نشط') }}
                        <i class="la la-check font-medium-2"></i>
                    </span>
                    @endif
                </td>
                <td class="product-action">
                    <span class="action-edit text-primary">
                    <a href="{{ route('admin.admins.edit', ['id' => $admin->id]) }}">
                        <i class="feather icon-edit"></i>
                    </a>
                    </span>
                    <span class="text-primary">
                    <a href="{{ route('admin.admins.show', ['id' => $admin->id]) }}">
                        <i class="feather icon-eye"></i>
                    </a>
                    </span>
                    @if ($admin->id != 1 && auth()->id() != $admin->id)
                    <span class="delete-row text-danger"
                            data-url="{{ url('admin/admins/' . $admin->id) }}">
                        <i class="feather icon-trash"></i>
                    </span>
                    @endif
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($admins->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{awtTrans('لا يوجد نتائج مطابقة')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($admins->count() > 0 && $admins instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$admins->links()}}
    </div>
@endif
{{-- pagination  links div --}}