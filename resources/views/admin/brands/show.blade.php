@extends('admin.layout.master')

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{awtTrans('عرض ماركه ')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form  class="show form-horizontal" >
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
                                                    <div class="uploadedBlock">
                                                        <img src="{{$brand->image}}">
                                                        <button class="close"><i class="feather icon-x"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @foreach (languages() as $lang)
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('site.name_'.$lang)}}</label>
                                            <div class="controls">
                                                <input type="text" value="{{$brand->getTranslations('name')[$lang]}}" name="name[{{$lang}}]" class="form-control" placeholder="{{__('site.write') . __('site.name_'.$lang)}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">{{awtTrans('حاله التفعيل')}}</label>
                                        <div class="controls">
                                            <select name="active" class="select2 form-control" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                                <option value>{{awtTrans('اختر حاله التفعيل')}}</option>
                                                <option {{$brand->active == 1 ? 'selected' : ''}} value="1">{{awtTrans('مفعل')}}</option>
                                                <option {{$brand->active == 0 ? 'selected' : ''}} value="0">{{awtTrans('غير مفعل')}}</option>
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
                                                    <option {{$role->id == $brand->role_id ? 'selected' : ''}} value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-12 d-flex justify-content-center mt-3">
                                    <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{awtTrans('تعديل')}}</button>
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
        $('.show input').attr('disabled' , true)
        $('.show textarea').attr('disabled' , true)
        $('.show select').attr('disabled' , true)
    </script>
@endsection