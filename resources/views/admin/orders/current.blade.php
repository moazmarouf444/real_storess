@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/index_page.css')}}">
@endsection

@section('content')

    <x-admin.table
            datefilter="true"
            order="true"
            extrabuttons="true"
            deletebutton="{{ route('admin.orders.deleteAll') }}"
            :searchArray="[

    ]"
    >

        <x-slot name="extrabuttonsdiv">
            {{-- <a type="button" data-toggle="modal" data-target="#notify" class="btn bg-gradient-info mr-1 mb-1 waves-effect waves-light notify" data-id="all"><i class="feather icon-bell"></i> {{ awtTrans('ارسال اشعار') }}</a> --}}
        </x-slot>

        <x-slot name="tableContent">
            <div class="table_content_append">
                {{-- table content will appends here  --}}
            </div>
        </x-slot>
    </x-admin.table>



@endsection

@section('js')

    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>
    @include('admin.shared.deleteAll')
    @include('admin.shared.deleteOne')
    @include('admin.shared.filter_js' , [ 'index_route' => url('admin/orders-current')])
@endsection
