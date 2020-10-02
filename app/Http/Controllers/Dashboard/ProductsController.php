<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Enumeration\CategoryType;
use App\Http\Requests\GeneralProductRequest;
use App\Http\Requests\MainCategoryRequest;
use App\models\Brand;
use App\Models\Category;
use App\models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ProductsController extends Controller
{
    //
    public function index()
    {

    }



   public function create()
    {
        $data =[];
        $data['brands'] = Brand::active()->select('id')->get();
        $data['tags'] = Tag::select('id')->get();
        $data['categories'] = Category::active()->select('id')->get();
//        return  $data;
        return view('dashboard.products.general.create', $data);
    }



    public function store(GeneralProductRequest $request)
    {
    //   return $request;
        try {

            DB::beginTransaction();
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


//            Remove parent_id  from request if main cat is checked//
            if($request -> type == CategoryType::mainCategory) //main category
            {
                $request->request->add(['parent_id' => null]);
            }

            $product = Product::create($request->except('_token'));
//         save translation == name (Translatable attribute in Model)//
            $product->name = $request->name;
            $product->save();
            DB::commit();

            return redirect()->route('dashboard.products')->with(['success' => 'تمت إضافه قسم جديد بنجاح']);
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
