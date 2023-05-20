@extends('admin.layout.master')

@section('content')
  <!-- // Basic multiple Column Form section start -->
  <section id="multiple-column-form">
    <div class="row match-height">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">{{ awtTrans('عرض مشرف ') }}</h4>
          </div>
          <div class="card-content">
            <div class="card-body">
              <form class="store form-horizontal">
                <div class="form-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="imgMontg col-12 text-center">
                        <div class="dropBox">
                          <div class="textCenter">
                            <div class="imagesUploadBlock">
                              <label class="uploadImg">
                                <span><i class="feather icon-image"></i></span>
                                <input type="file" accept="image/*" name="avatar"
                                       class="imageUploader">
                              </label>
                              <div class="uploadedBlock">
                                <img src="{{ $admin->avatar }}">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 col-12">
                      <div class="form-group">
                        <label for="first-name-column">{{ awtTrans('الاسم') }}</label>
                        <div class="controls">
                          <input type="text" name="name" value="{{ $admin->name }}"
                                 class="form-control"
                                 placeholder="{{ awtTrans('اكتب الاسم') }}" required
                                 data-validation-required-message="{{ awtTrans('هذا الحقل مطلوب') }}">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="form-group">
                        <label for="first-name-column">{{ awtTrans('رقم الهاتف') }}</label>
                        <div class="controls">
                          <input type="number" name="phone" value="{{ $admin->phone }}"
                                 class="form-control"
                                 placeholder="{{ awtTrans('اكتب رقم الهاتف') }}" required
                                 data-validation-required-message="{{ awtTrans('هذا الحقل مطلوب') }}">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="form-group">
                        <label
                               for="first-name-column">{{ awtTrans('البريد الالكتروني') }}</label>
                        <div class="controls">
                          <input type="email" name="email" value="{{ $admin->email }}"
                                 class="form-control"
                                 placeholder="{{ awtTrans('اكتب البريد الالكتروني') }}"
                                 required
                                 data-validation-required-message="{{ awtTrans('هذا الحقل مطلوب') }}">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="form-group">
                        <label for="first-name-column">{{ awtTrans('كلمة السر') }}</label>
                        <div class="controls">
                          <input type="password" name="password" class="form-control">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12 col-12">
                      <div class="form-group">
                        <label for="first-name-column">{{ awtTrans('الصلاحية') }}</label>
                        <div class="controls">
                          <select name="block" class="select2 form-control" required
                                  data-validation-required-message="{{ awtTrans('هذا الحقل مطلوب') }}">
                            <option value>{{ awtTrans('اختر حالة الحظر') }}</option>
                            <option {{ $admin->block == 1 ? 'selected' : '' }} value="1">
                              {{ awtTrans('محظور') }}</option>
                            <option {{ $admin->block == 0 ? 'selected' : '' }} value="0">
                              {{ awtTrans('غير محظور') }}</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-12">
                      <div class="form-group">
                        <label for="first-name-column">{{ awtTrans('الصلاحية') }}</label>
                        <div class="controls">
                          <select name="role_id" class="select2 form-control" required
                                  data-validation-required-message="{{ awtTrans('هذا الحقل مطلوب') }}">
                            <option value>{{ awtTrans('اختر الصلاحية') }}</option>
                            @foreach ($roles as $role)
                              <option {{ $role->id == $admin->role_id ? 'selected' : '' }}
                                      value="{{ $role->id }}">{{ $role->name }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center mt-3">
                      <a href="{{ url()->previous() }}" type="reset"
                         class="btn btn-outline-warning mr-1 mb-1">{{ awtTrans(' رجوع ') }}</a>
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
    $('.store input').attr('disabled', true)
    $('.store textarea').attr('disabled', true)
    $('.store select').attr('disabled', true)
  </script>
@endsection
