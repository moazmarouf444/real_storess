<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\loginRequest;
use App\Models\SiteSetting;
use App\Services\SettingService;
use App\Traits\AdminFirstRouteTrait;
use Illuminate\Support\Facades\Route;

class AuthController extends Controller {
  use AdminFirstRouteTrait;
  public function SetLanguage($lang) {
    if (in_array($lang, ['ar', 'en'])) {

      if (session()->has('lang')) {
        session()->forget('lang');
      }

      session()->put('lang', $lang);

    } else {
      if (session()->has('lang')) {
        session()->forget('lang');
      }

      session()->put('lang', 'ar');
    }
    return back();
  }

  public function showLoginForm() {
    $data = SettingService::appInformations(SiteSetting::pluck('value', 'key'));
    return view('admin.auth.login', compact('data'));
  }

  public function login(loginRequest $request) {
    $remember = 1 == $request->remember ? true : false;
    if (auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {

      session()->put('lang', 'ar');
      return response()->json(['status' => 'login', 'url' => route($this->getAdminFirstRouteName()), 'message' => awtTrans('تم تسجيل الدخول بنجاح')]);

    } else {
      return response()->json(['status' => 0, 'message' => awtTrans('كلمة السر غير صحيحة')]);
    }
  }

  public function logout() {
    auth('admin')->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect(route('admin.login'));
  }
}
