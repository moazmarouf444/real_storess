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
                <th>{{awtTrans('التاريخ')}}</th>
                <th>{{awtTrans('الاسم')}}</th>
                <th>{{awtTrans('الدولة')}}</th>
                <th>{{awtTrans('التحكم')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cities as $city)
                <tr class="delete_city">
                    <td class="text-center">
                        <label class="container-checkbox">
                            <input type="checkbox" class="checkSingle" id="{{$city->id}}">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td>{{\Carbon\Carbon::parse($city->created_at)->format('d/m/Y')}}</td>
                    <td>{{$city->name}}</td>
                    <td>{{$city->country->name}}</td>
                    <td class="product-action">
                        <span class="text-primary"><a href="{{route('admin.cities.show' , ['id' => $city->id])}}"><i class="feather icon-eye"></i></a></span>
                        <span class="action-edit text-primary"><a href="{{route('admin.cities.edit' , ['id' => $city->id])}}"><i class="feather icon-edit"></i></a></span>
                        <span class="delete-row text-danger" data-url="{{url('admin/cities/'.$city->id)}}"><i class="feather icon-trash"></i></span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($cities->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{awtTrans('لا يوجد نتائج مطابقة')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($cities->count() > 0 && $cities instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$cities->links()}}
    </div>
@endif
{{-- pagination  links div --}}