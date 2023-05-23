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

        .upload_alotImg > input {
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

        .img-uploaded-one > img {
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
                    <h4 class="card-title">{{awtTrans('تعديل منتج ')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form  method="POST" action="{{route('admin.products.update' , ['id' => $product->id])}}" class="store form-horizontal" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="row">

                                    @foreach (languages() as $lang)
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('site.name_'.$lang)}}</label>
                                                <div class="controls">
                                                    <input type="text" value="{{$product->getTranslations('name')[$lang]}}" name="name[{{$lang}}]" class="form-control" placeholder="{{__('site.write') . __('site.name_'.$lang)}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('السعر')}}</label>
                                            <div class="controls">
                                                <input type="number" value="{{$product->price}}" name="price" class="form-control"
                                                       placeholder="{{awtTrans('اكتب السعر')}}" required
                                                       data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('سعر البيع')}}</label>
                                            <div class="controls">
                                                <input type="number"  value="{{$product->selling_price}}" name="selling_price" class="form-control"
                                                       placeholder="{{awtTrans('اكتب سعر البيع')}}" required
                                                       data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('الكميه ')}}</label>
                                            <div class="controls">
                                                <input type="number"  value="{{$product->qty}}" name="qty" class="form-control"
                                                       placeholder="{{awtTrans('اكتب الكميه')}}" required
                                                       data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}">
                                            </div>
                                        </div>
                                    </div>

                                        <div class="col-md-6 col-6">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('حاله التفعيل')}}</label>
                                                <div class="controls">
                                                    <select name="is_active" class="select2 form-control" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                                        <option value>{{awtTrans('اختر حاله التفعيل')}}</option>
                                                        <option {{$product->is_active == 1 ? 'selected' : ''}} value="1">{{awtTrans('مفعل')}}</option>
                                                        <option {{$product->is_active == 0 ? 'selected' : ''}} value="0">{{awtTrans('غير مفعل')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('التصنيف')}}</label>
                                            <div class="controls">
                                                <select name="category_id" class="select2 form-control" required
                                                        data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}">
                                                    <option value>{{awtTrans('اختر التصنيف')}}</option>
                                                    @if($categories && $categories -> count() > 0)
                                                        @foreach($categories as $category)
                                                            <option
                                                                    {{$product->category_id == $category->id ? 'selected' : ''}}
                                                                    value="{{$category -> id }}">{{$category -> name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('الماركه')}}</label>
                                            <div class="controls">
                                                <select name="brand_id" class="select2 form-control"
                                                    @if($brands && $brands -> count() > 0)
                                                    <option value="">{{awtTrans('اختر الماركه')}}</option>

                                                @foreach($brands as $brand)
                                                            <option
                                                                    {{$product->brand_id == $brand->id ? 'selected' : ''}}
                                                                    value="{{$brand -> id }}">{{$brand -> name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    @foreach (languages() as $lang)
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                @error('description')
                                                <span class="text-danger">{{'description'.$lang}}</span>
                                                @enderror

                                                @include('admin.includes.alerts.input-errors', ['input' => "description.$lang"])

                                                <label for="account-name">{{__('site.description_'.$lang)}}</label>
                                                <textarea  class="form-control" name="description[{{$lang}}]"
                                                          id="description[{{$lang}}]" cols="30" rows="10"
                                                          placeholder="{{awtTrans('الوصف')}}">{!! $product->description !!}</textarea>
                                            </div>

                                        </div>
                                    @endforeach

                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <button type="submit"
                                                class="btn btn-primary mr-1 mb-1 submit_button">{{awtTrans('تعديل')}}</button>
                                        <a href="{{ url()->previous() }}" type="reset"
                                           class="btn btn-outline-warning mr-1 mb-1">{{awtTrans(' رجوع ')}}</a>
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
    

    {{-- submit edit form script --}}
        @include('admin.shared.submitEditForm')
    {{-- submit edit form script --}}
    <script src="https://cdn.ckeditor.com/4.16.2/full-all/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description[{{"ar"}}]');
        CKEDITOR.replace('description[{{"en"}}]');
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