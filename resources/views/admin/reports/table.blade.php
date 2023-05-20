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
                <th>{{awtTrans('*')}}</th>
                {{-- <th>{{awtTrans('الرابط')}}</th> --}}
                <th>{{awtTrans('ال ip')}}</th>
                <th>{{awtTrans('التحكم')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr class="delete_report">
                    <td class="text-center">
                        <label class="container-checkbox">
                            <input type="checkbox" class="checkSingle" id="{{$report->id}}">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td>{{$report->subject}}</td>
                    {{-- <td><a href="{{$report->url}}"> {{awtTrans('اضغط هنا')}} </a></td> --}}
                    <td>{{$report->ip}}</td>
                    <td class="product-action">
                        <span class="action-edit text-primary"><a href="{{route('admin.reports.show' , ['id' => $report->id])}}"><i class="feather icon-eye"></i></a></span>
                        <span class="delete-row text-danger" data-url="{{url('admin/reports/'.$report->id)}}"><i class="feather icon-trash"></i></span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($reports->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{awtTrans('لا يوجد نتائج مطابقة')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($reports->count() > 0 && $reports instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$reports->links()}}
    </div>
@endif
{{-- pagination  links div --}}