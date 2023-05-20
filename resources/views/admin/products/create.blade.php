@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">

    <style>
        .upload_alotImg {
            width: 150px;
            height: 150px;
            border: 1px solid #EEE;
            border-radius: 10px;
            overflow: hidden;
            font-size: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            font-weight: bolder
        }

        .upload_alotImg>input {
            position: absolute;
            width: 100%;
            height: 100%;
            font-size: 0;
            transform: scale(1.1);
            z-index: 3;
            cursor: pointer
        }

        .img-uploaded-one {
            width: 150px;
            height: 150px;
            border: 1px solid #EEE;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            margin: 10px;
        }

        .img-uploaded-one>img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .img-uploaded-one .remove-appendedd {
            position: absolute;
            left: 5px;
            top: 7px;
            z-index: 18;
            width: 20px;
            background: crimson;
            height: 20px;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 11px;
            color: #FFF;
            border-radius: 50%;
        }
    </style>

@endsection
{{-- extra css files --}}

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{awtTrans('اضافه منتج ')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form  method="POST" action="{{route('admin.products.store')}}" class="store form-horizontal" novalidate>
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="imgMontg col-12 text-center">
                                            <div class="dropBox">
                                                <div class="textCenter">
                                                    <div class="imagesUploadBlock">
                                                        <label class="uploadImg">
                                                            <span><i class="feather icon-image"></i></span>
                                                            <input type="file" accept="image/*" name="image" class="imageUploader">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- @foreach (languages() as $lang)
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('site.name_'.$lang)}}</label>
                                                <div class="controls">
                                                    <input type="text" name="name[{{$lang}}]" class="form-control" placeholder="{{__('site.write') . __('site.name_'.$lang)}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach --}}

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('الاسم')}}</label>
                                            <div class="controls">
                                                <input type="text" name="name" class="form-control" placeholder="{{awtTrans('اكتب الاسم')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('رقم الهاتف')}}</label>
                                            <div class="controls">
                                                <input type="number" name="phone" class="form-control" placeholder="{{awtTrans('اكتب رقم الهاتف')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('البريد الالكتروني')}}</label>
                                            <div class="controls">
                                                <input type="email" name="email" class="form-control" placeholder="{{awtTrans('اكتب البريد الالكتروني')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('كلمة السر')}}</label>
                                            <div class="controls">
                                                <input type="password" name="password" class="form-control"  required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('عن التطبيق ')}}</label>
                                                <textarea class="form-control" name="intro_about" id="" cols="30" rows="10" placeholder="{{awtTrans('عن التطبيق')}}"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('حالة الحظر')}}</label>
                                            <div class="controls">
                                                <select name="block" class="select2 form-control" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                                    <option value>{{awtTrans('اختر حالة الحظر')}}</option>
                                                    <option value="1">{{awtTrans('محظور')}}</option>
                                                    <option value="0">{{awtTrans('غير محظور')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('الصلاحية')}}</label>
                                            <div class="controls">
                                                <select name="role_id" class="select2 form-control" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                                    <option value>{{awtTrans('اختر الصلاحية')}}</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}



                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{awtTrans('اضافة')}}</button>
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
    <script src="{{asset('admin/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>
    
    {{-- show selected image script --}}
        @include('admin.shared.addImage')
    {{-- show selected image script --}}

    {{-- submit add form script --}}
        @include('admin.shared.submitAddForm')
    {{-- submit add form script --}}
    <script>
        $(document).on('change', '#mangeStock', function () {

            if ($(this).val() == 1) {

                $('#qtyDiv').show();
            } else {
                $('#qtyDiv').hide();

            }
        });
    </script>
    <script>
        $(document).on('change', '#up-img-all', function (event) {
            for (var i = 0; i <= event.target.files.length; i++) {
                $('.file_alotImage').append('<div id="remove-div' + i + '" class="img-uploaded-one"><span class="remove-appendedd" onClick="removeParent(' + i + ')" >X</span><img src="' + URL.createObjectURL(event.target.files[i]) + '" alt=""></div>');
            }
        });

        $(document).on('click', '.remove-appendedd', function () {
            $(this).parent().remove();
        });
    </script>

@endsection