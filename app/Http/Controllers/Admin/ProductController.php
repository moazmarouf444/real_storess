<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\products\Store;
use App\Http\Requests\Admin\products\Update;
use App\Models\Product ;
use App\Traits\Report;


class ProductController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $products = Product::search(request()->searchArray)->paginate(30);
            $html = view('admin.products.table' ,compact('products'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.products.index');
    }

    public function create()
    {
        $brands = Brand::active()->select('id','name')->get();
        $categories = Category::select('id','name')->get();
        return view('admin.products.create',compact('brands','categories'));
    }


    public function store(Store $request)
    {
        if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);

        $product =   Product::create($request->validated()+ ['is_active' => $request->is_active]);
        if ($request->images) {
            foreach ($request->images as $file) {
                $product->photos()->create([
                    'image' => $file
                ]);
            }
        }
        Report::addToLog('  اضافه منتج') ;
        return response()->json(['url' => route('admin.products.index')]);
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::active()->select('id','name')->get();
        $categories = Category::select('id','name')->get();

        return view('admin.products.edit', compact('product','categories','brands'));
    }

    public function update(Update $request, $id)
    {
        $product = Product::findOrFail($id)->update($request->validated());
        if ($request->images) {
            foreach ($request->images as $file) {
                $product->photos()->updateOrCreate([
                    'image' => $file
                ]);
            }
        }

        Report::addToLog('  تعديل منتج') ;
        return response()->json(['url' => route('admin.products.index')]);
    }

    public function show($id)
    {
        $brands = Brand::active()->select('id','name')->get();
        $categories = Category::select('id','name')->get();

        $product = Product::findOrFail($id);
        return view('admin.products.show' , compact('product','categories','brands'));
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id)->delete();
        Report::addToLog('  حذف منتج') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Product::WhereIn('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من منتجات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
