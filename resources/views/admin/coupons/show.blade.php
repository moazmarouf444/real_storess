@extends('admin.layout.master')

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="coupon match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{awtTrans('عرض كوبون ')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form  class="store form-horizontal" >
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('رقم الكوبون')}}</label>
                                            <div class="controls">
                                                <input type="text" name="coupon_num" value="{{$coupon->coupon_num}}" class="form-control" placeholder="{{awtTrans('اكتب رقم الكوبون')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('عدد مرات الاستخدام')}}</label>
                                            <div class="controls">
                                                <input type="number" name="max_use" value="{{$coupon->max_use}}" class="form-control" placeholder="{{awtTrans('اكتب عدد مرات الاستخدام')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('نوع الخصم')}}</label>
                                            <div class="controls">
                                                <select name="type" class="select2 form-control" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                                    <option value>{{awtTrans('اختر حالة الخصم')}}</option>
                                                    <option {{$coupon->type == 'ratio' ? 'selected' : ''}} value="ratio">{{awtTrans('نسبة')}}</option>
                                                    <option {{$coupon->type == 'number' ? 'selected' : ''}} value="number">{{awtTrans('رقم ثابت')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('قيمة الخصم')}}</label>
                                            <div class="controls">
                                                <input type="number" value="{{$coupon->discount}}" name="discount" class="discount form-control" placeholder="{{awtTrans('اكتب قيمة الخصم')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('اكبر قيمة للخصم')}}</label>
                                            <div class="controls">
                                                <input readonly type="number" value="{{$coupon->max_discount}}" name="max_discount" class="max_discount form-control" placeholder="{{awtTrans('اكتب اكبر قيمة للخصم')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('تاريخ الانتهاء')}}</label>
                                            <div class="controls">
                                                <input  type="text" value="{{date('M,Y d', strtotime($coupon->expire_date));}}" name="expire_date" class="pickadate form-control"  required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{awtTrans(' رجوع ')}}</a>
                                    </div>
                                    
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
        $('.store input').attr('disabled' , true)
        $('.store textarea').attr('disabled' , true)
        $('.store select').attr('disabled' , true)

    </script>
@endsection