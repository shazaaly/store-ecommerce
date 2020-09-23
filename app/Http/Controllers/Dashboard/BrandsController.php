<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandsController extends Controller
{
    //
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);    //*scopeParent ()  in Model*/
        return view('dashboard.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('dashboard.brands.create');
    }
    public function store(BrandRequest $request)
    {
       // return $request;
        try {

            DB::beginTransaction();
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $filename="";
            if ($request->has('photo')){
                $filename = uploadImage('brands', $request->photo);
            }

            $brand = Brand::create($request->except('_token', 'photo'));
//         save translation == name (Translatable attribute in Model)//
            $brand->name = $request->name;
            $brand->photo = $filename;

            $brand->save();
            DB::commit();

            return redirect()->route('dashboard.brands')->with(['success' => 'تمت إضافه قسم جديد بنجاح']);
        } catch (\Exception $ex) {
            return $ex;
            DB::rollBack();
            return redirect()->back()->with(['error' => 'خطأ في إضافه قسم جديد -يرجى المحاولة فيما بعد']);
        }

    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return redirect()->back()->with(['error' => 'هذه الماركة التجارية غير موجود']);

        }
        return view('dashboard.brands.edit', compact('brand'));

    }
    public function update(BrandRequest $request, $id)
    {
//      return $request;

        try {
            $brand = Brand::find($id);
            if (!$brand) {
                return redirect()->back()->with(['error' => 'هذا القسم غير موجود']);
            }
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            DB::beginTransaction();

//update photo
            if ($request->has('photo')){
                $filename = uploadImage('brands', $request->photo);
                Brand::where('id', $id)->update([
                    'photo'=>$filename
                ]);
            }


            $brand->update($request->except('token','id', 'photo'));
//save translation://
            $brand->name = $request->name;
            $brand->save();
            DB::commit();

            return redirect()->route('dashboard.brands')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            return $ex;
            DB::rollBack();
            return redirect()->back()->with(['error' => 'خطأ في تجديث البيانات']);
        }

    }
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return redirect()->back()->with(['error' => 'هذا القسم غير موجود']);

        }
        $brand->delete();
        return redirect()->route('dashboard.brands')->with(['success' => 'تم الحذف بنجاح']);


    }




}
