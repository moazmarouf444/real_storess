@extends('admin.layout.master')

@section('content')
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{awtTrans('عرض طلب ')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="show form-horizontal">
                                <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-column">{{awtTrans('رقم الطلب')}}</label>
                                        <div class="controls">
                                            <input type="text"
                                                   value="{{$order->order_num}}"
                                                   name="" class="form-control"></input>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-column">{{awtTrans('سعر الطلب ')}}</label>
                                        <div class="controls">
                                            <input type="text"
                                                   value="{{$order->price}}"
                                                   name="" class="form-control"></input>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-column">{{awtTrans('حاله الطلب ')}}</label>
                                        <div class="controls">
                                            <input type="text"
                                                   value="
                                                       @if($order->status == 'current')
                                                      {{awtTrans('قيد التنفيذ')}}
                                                       @elseif($order->status == 'cancelled')
                                                      {{awtTrans('ملغي')}}
                                                       @elseif($order->status == 'finished')
                                                      {{awtTrans('مكتلمل')}}
                                                       @endif
                                               "
                                                   name="" class="form-control"></input>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-column">{{awtTrans('حاله الدفع ')}}</label>
                                        <div class="controls">
                                            <input  type="text"
                                                   value="@if($order->pay_status == 'done')
                                                      {{awtTrans('تم الدفع')}}
                                                      @else
                                                       {{awtTrans('لم يتم الدفع الدفع')}}
                                                           @endif
                                                             "

                                                   name="" class="form-control"></input>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-column">{{awtTrans('نوع الدفع ')}}</label>
                                        <div class="controls">
                                            <input  type="text"
                                                   value=" {{ $order->getPaidType() }}"
                                                   name="" class="form-control"></input>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-column">{{awtTrans('اسم العميل')}}</label>
                                        <div class="controls">
                                            <input type="text"
                                                   value="{{$order->user->name}}"
                                                   name="" class="form-control"></input>
                                        </div>
                                    </div>


                                </div>
                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{awtTrans(' رجوع ')}}</a>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>
        $('.show input').attr('disabled', true)
        $('.show textarea').attr('disabled', true)
        $('.show select').attr('disabled', true)
    </script>
@endsection