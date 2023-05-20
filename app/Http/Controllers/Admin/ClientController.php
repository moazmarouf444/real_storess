<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Jobs\Notify;
use App\Models\User;
use App\Traits\Report;
use App\Jobs\BlockUser;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Client\Store;
use App\Http\Requests\Admin\Client\Update;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NotifyUser  ;
use Mail;
use App\Mail\SendMail;

class ClientController extends Controller {

  public function index($id = null)
  {
      if (request()->ajax()) {
          $rows = User::search(request()->searchArray)->paginate(30);
          $html = view('admin.clients.table' ,compact('rows'))->render() ;
          return response()->json(['html' => $html]);
      }
      return view('admin.clients.index');
  }

  public function create() {
    return view('admin.clients.create');
  }

  public function store(Store $request) {
    User::create($request->validated());
    Report::addToLog('  اضافه مستخدم');
    return response()->json(['url' => route('admin.clients.index')]);
  }

  public function edit($id) {
    $row = User::findOrFail($id);
    return view('admin.clients.edit', ['row' => $row]);
  }

  public function update(Update $request, $id) {
    $user = User::findOrFail($id)->update($request->validated());
    Report::addToLog('  تعديل مستخدم');
    return response()->json(['url' => route('admin.clients.index')]);
  }

  public function show($id) {
    $row = User::findOrFail($id);
    return view('admin.clients.show', ['row' => $row]);
  }

  public function destroy($id) {
    $user = User::findOrFail($id)->delete();
    Report::addToLog('  حذف مستخدم');
    return response()->json(['id' => $id]);
  }

  public function blockUser($id) {
    $user = User::findOrFail($id);
    dispatch(new BlockUser($user));
    return redirect()->back()->with('success', 'تم حظر المستخدم بنجاح');
  }

  public function notify(Request $request) {
    if ($request->notify == 'notifications') {
        if ('all' == $request->id) {
          $clients = User::latest()->get();
          Notification::send( $clients , new NotifyUser($request->all()));
        } else {
          $client = User::findOrFail($request->id);
          Notification::send( $client , new NotifyUser($request->all()));
        }
    }else{
        if ('all' == $request->id) {
          $mails = User::where('email' , '!=' , null)->get()->pluck('email')->toArray();
          Mail::to($mails)->send(new SendMail(['title' => 'اشعار اداري' , 'message' =>  $request->message]));
        } else {
          $mail = User::findOrFail($request->id)->email;
          Mail::to($mail)->send(new SendMail(['title' => 'اشعار اداري' , 'message' =>  $request->message]));
        }
    }
    return response()->json();
  }

  public function destroyAll(Request $request) {
    $requestIds = json_decode($request->data);

    foreach ($requestIds as $id) {
      $ids[] = $id->id;
    }
    if (User::whereIn('id', $ids)->get()->each->delete()) {
      Report::addToLog('  حذف العديد من المستخدمين');
      return response()->json('success');
    } else {
      return response()->json('failed');
    }
  }
}
