<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\Create;
use App\Http\Requests\Admin\Admin\Update;
use App\Models\Admin;
use App\Models\Role;
use App\Traits\Report;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class AdminController extends Controller {
  use ResponseTrait;

  public function index($id = null)
  {
      if (request()->ajax()) {
          $admins = Admin::search(request()->searchArray)->paginate(30);
          $html = view('admin.admins.table' ,compact('admins'))->render() ;
          return response()->json(['html' => $html]);
      }
      return view('admin.admins.index');
  }

  public function create() {
    $roles = Role::latest()->get();
    return view('admin.admins.create', compact('roles'));
  }

  public function store(Create $request) {
    Admin::create($request->validated());
    Report::addToLog('  اضافه مدير');
    return $this->successOtherData(['url' => route('admin.admins.index')]);
  }

  public function edit($id) {
    $admin = Admin::findOrFail($id);
    $roles = Role::latest()->get();
    return view('admin.admins.edit', ['admin' => $admin, 'roles' => $roles]);
  }

  public function update($id, Update $request) {
    $admin = Admin::findOrFail($id);
    $admin->update($request->validated());
    Report::addToLog('  تعديل مدير');
    return $this->successOtherData(['url' => route('admin.admins.index')]);
  }

  public function show($id) {
    $admin = Admin::findOrFail($id);
    $roles = Role::latest()->get();
    return view('admin.admins.show', ['admin' => $admin, 'roles' => $roles]);
  }

  public function destroy($id) {
    if (1 == $id) {
      return;
    }

    Admin::findOrFail($id)->delete();
    Report::addToLog('  حذف مدير');
    return $this->successOtherData(['id' => $id]);

  }

  public function destroyAll(Request $request) {
    $requestIds = array_column(json_decode($request->data), 'id');
    Admin::whereIn('id', $requestIds)->where('id', '!=', 1)->get()->each->delete();
    Report::addToLog('  حذف العديد من المديرين');
    return response()->json('success');
    //return response()->json('failed');
  }

  public function notifications() {
    auth('admin')->user()->unreadNotifications->markAsRead();
    return view('admin.admins.notifications');
  }

  public function deleteNotifications(Request $request) {
    $requestIds = array_column(json_decode($request->data), 'id');
    auth('admin')->user()->notifications()->whereIn('id', $requestIds)->delete();
    return $this->successMsg();
  }
}
