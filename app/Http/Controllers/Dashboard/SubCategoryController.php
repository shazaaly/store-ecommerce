<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SubCategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::child()->orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);    //*scopeParent ()  in Model*/
        $mainCategories = Category::parent()->orderBy('id', 'DESC');    //*scopeParent ()  in Model*/

        return view('dashboard.subcategories.index', compact('categories', 'mainCategories'));
    }



   public function create()
    {
        $categories = Category::parent()->orderBy('id', 'DESC')->get();    /*scopeParent ()  in Model*/
        return view('dashboard.subcategories.create', compact('categories'));
    }



    public function store(SubCategoryRequest $request)
    {
//        return $request;
        try {

            DB::beginTransaction();
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $category = Category::create($request->except('_token'));
//         save translation == name (Translatable attribute in Model)//
            $category->name = $request->name;
            $category->save();
            DB::commit();

            return redirect()->route('admin.subcategories')->with(['success' => 'تمت إضافه قسم فرعي جديد بنجاح']);
        } catch (\Exception $ex) {
            return $ex;
            DB::rollBack();
            return redirect()->back()->with(['error' => 'خطأ في إضافه قسم فرعي جديد -يرجى المحاولة فيما بعد']);
        }

    }

    public function edit($id)
    {

        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('dashboard.subcategories.edit')->with(['error' => 'هذا القسم غير موجود']);

        }

        $categories = Category::parent()->orderBy('id', 'DESC')->get();    /*scopeParent ()  in Model*/
        return view('dashboard.subcategories.edit', compact('category','categories'));

    }

    public function update(SubCategoryRequest $request, $id)
    {
//    return $request;

        try {
            $category = Category::find($id);
            if (!$category) {
                return redirect()->back()->with(['error' => 'هذا القسم غير موجود']);
            }
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            DB::beginTransaction();

            $category->update($request->all());
            $category->name = $request->name;
            $category->save();
            DB::commit();

            return redirect()->route('dashboard.subcategories')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
//            return $ex;
            DB::rollBack();
            return redirect()->back()->with(['error' => 'خطأ في تجديث البيانات']);
        }

    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->back()->with(['error' => 'هذا القسم غير موجود']);

        }
        $category->delete();
        return redirect()->route('dashboard.subcategories')->with(['success' => 'تم الحذف بنجاح']);


    }

}
