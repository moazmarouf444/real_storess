<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\orders\Store;
use App\Http\Requests\Admin\orders\Update;
use App\Models\Order ;
use App\Traits\Report;


class OrderController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $orders = Order::search(request()->searchArray)->paginate(30);
            $html = view('admin.orders.table' ,compact('orders'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.orders.index');
    }
    public function orderCurrent($id = null)
    {

        if (request()->ajax()) {
            $orders = Order::search(request()->searchArray)->current()->paginate(30);
            $html = view('admin.orders.table' ,compact('orders'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.orders.current');
    }

    public function orderFinished()
    {
//        dd(Order::first()->get());
        if (request()->ajax()) {
            $orders = Order::search(request()->searchArray)->finish()->paginate(30);
            $html = view('admin.orders.table' ,compact('orders'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.orders.finished');
    }

    public function orderCancelled()
    {
//        dd(Order::first()->get());
        if (request()->ajax()) {
            $orders = Order::search(request()->searchArray)->cancel()->paginate(30);
            $html = view('admin.orders.table' ,compact('orders'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.orders.cancelled');
    }



    public function create()
    {
        return view('admin.orders.create');
    }


    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.show' , ['order' => $order]);
    }
    public function destroy($id)
    {
        $order = Order::findOrFail($id)->delete();
        Report::addToLog('  حذف طلب') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Order::WhereIn('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من طلبات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
