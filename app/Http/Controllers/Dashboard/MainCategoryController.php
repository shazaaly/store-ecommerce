<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MainCategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);    //*scopeParent ()  in Model*/

        return view('dashboard.categories.index', compact('categories'));
    }



   public function create()
    {
        $categories =   Category::select('id','parent_id')->get();
        return view('dashboard.categories.create', compact('categories'));
    }



    public function store(MainCategoryRequest $request)
    {
        try {

            DB::beginTransaction();
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


//            Remove parent_id  from request if main cat is checked//
            if($request -> type == 1) //main category
            {
                $request->request->add(['parent_id' => null]);
            }

            $category = Category::create($request->except('_token'));
//         save translation == name (Translatable attribute in Model)//
            $category->name = $request->name;
            $category->save();
            DB::commit();

            return redirect()->route('dashboard.categories.index')->with(['success' => 'تمت إضافه قسم جديد بنجاح']);
        } catch (\Exception $ex) {
            return $ex;
            DB::rollBack();
            return redirect()->back()->with(['error' => 'خطأ في إضافه قسم جديد -يرجى المحاولة فيما بعد']);
        }

    }

    public function edit($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->back()->with(['error' => 'هذا القسم غير موجود']);

        }
        return view('dashboard.categories.edit', compact('category'));

    }

    public function update(MainCategoryRequest $request, $id)
    {
//      return $request;

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
            $category->parent_id = $request->mainCategory;
            $category->save();
            DB::commit();

            return redirect()->route('dashboard.categories.index')->with(['success' => 'تم التحديث بنجاح']);
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
        return redirect()->route('dashboard.categories.index')->with(['success' => 'تم الحذف بنجاح']);


    }

}
