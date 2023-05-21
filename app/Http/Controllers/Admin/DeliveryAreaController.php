<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\deliveryareas\Store;
use App\Http\Requests\Admin\deliveryareas\Update;
use App\Models\DeliveryArea ;
use App\Traits\Report;


class DeliveryAreaController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $deliveryareas = DeliveryArea::search(request()->searchArray)->paginate(30);
            $html = view('admin.deliveryareas.table' ,compact('deliveryareas'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.deliveryareas.index');
    }

    public function create()
    {
        return view('admin.deliveryareas.create');
    }


    public function store(Store $request)
    {
        DeliveryArea::create($request->validated());
        Report::addToLog('  اضافه منطقه توصيل') ;
        return response()->json(['url' => route('admin.deliveryareas.index')]);
    }
    public function edit($id)
    {
        $deliveryarea = DeliveryArea::findOrFail($id);
        return view('admin.deliveryareas.edit' , ['deliveryarea' => $deliveryarea]);
    }

    public function update(Update $request, $id)
    {
        $deliveryarea = DeliveryArea::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل منطقه توصيل') ;
        return response()->json(['url' => route('admin.deliveryareas.index')]);
    }

    public function show($id)
    {
        $deliveryarea = DeliveryArea::findOrFail($id);
        return view('admin.deliveryareas.show' , ['deliveryarea' => $deliveryarea]);
    }
    public function destroy($id)
    {
        $deliveryarea = DeliveryArea::findOrFail($id)->delete();
        Report::addToLog('  حذف منطقه توصيل') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (DeliveryArea::WhereIn('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من مناطق التوصيل') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
