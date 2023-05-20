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
                <th>{{awtTrans('عرض التصنيفات الفرعية')}}</th>
                <th>{{awtTrans('التحكم')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr class="delete_row">
                    <td class="text-center">
                        <label class="container-checkbox">
                            <input type="checkbox" class="checkSingle" id="{{$category->id}}">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td><img src="{{$category->image}}" width="50px" height="50px" alt=""></td>
                    <td>{{$category->name}}</td>
                    <td><a href="{{route('admin.categories.index' , ['id' => $category->id])}}">{{awtTrans('عرض')}}</a></td>
                    <td class="product-action">
                        <span class="text-primary"><a href="{{route('admin.categories.show' , ['id' => $category->id])}}"><i class="feather icon-eye"></i></a></span>
                        <span class="action-edit text-primary"><a href="{{route('admin.categories.edit' , ['id' => $category->id])}}"><i class="feather icon-edit"></i></a></span>
                        <span class="text-danger delete-row" data-url="{{url('admin/categories/'.$category->id)}}"><i class="feather icon-trash"></i></span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($categories->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{awtTrans('لا يوجد نتائج مطابقة')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($categories->count() > 0 && $categories instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$categories->links()}}
    </div>
@endif
{{-- pagination  links div --}}