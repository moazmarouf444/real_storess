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
                <th>{{awtTrans('الصوره')}}</th>
                <th>{{awtTrans('الاسم')}}</th>
                <th>{{awtTrans('حالة التفعيل')}}</th>
                <th>{{awtTrans('التحكم')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brands as $brand)
                <tr class="delete_row">
                    <td class="text-center">
                        <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $brand->id }}">
                        <span class="checkmark"></span>
                        </label>
                    </td>
                    <td><img src="{{$brand->image}}" width="50px" height="50px" alt=""></td>
                    <td>{{ $brand->name }}</td>
                    <td>{{ $brand->getActive() }}</td>

                    <td class="product-action"> 
                        <span class="text-primary"><a href="{{ route('admin.brands.show', ['id' => $brand->id]) }}"><i class="feather icon-eye"></i></a></span>
                        <span class="action-edit text-primary"><a href="{{ route('admin.brands.edit', ['id' => $brand->id]) }}"><i class="feather icon-edit"></i></a></span>
                        <span class="delete-row text-danger" data-url="{{ url('admin/brands/' . $brand->id) }}"><i class="feather icon-trash"></i></span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($brands->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{awtTrans('لا يوجد نتائج مطابقة')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($brands->count() > 0 && $brands instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$brands->links()}}
    </div>
@endif
{{-- pagination  links div --}}

