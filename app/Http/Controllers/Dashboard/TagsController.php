<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagsRequest;
use App\models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use phpDocumentor\Reflection\DocBlock\Tag;
use function GuzzleHttp\Promise\all;

class TagsController extends Controller
{
    //
    public function index()
    {

        $tags = Tag::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);    //*scopeParent ()  in Model*/

        return view('dashboard.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('dashboard.tags.create');
    }

    public function store(TagsRequest $request)
    {
       // return $request;
        DB::beginTransaction();

        //validation
        $tag= Tag::create(['slug'=>$request->slug]);

        //save translations
        $tag->name = $request->name;
        $tag->save();
        DB::commit();
        return redirect()->route('dashboard.tags')->with(['success' => 'تم ألاضافة بنجاح']);
    }

    public function edit($id)
    {
        $tag = Tag::find($id);

      //  $tag-> MakeVisible(['translations']);

        if (!$tag) {
            return redirect()->back()->with(['error' => 'هذه الماركة التجارية غير موجود']);

        }
        return view('dashboard.tags.edit', compact('tag'));

    }
    public function update(Request $request, $id)
    {
//      return $request;

        try {
            $tag = Tag::find($id);
            if (!$tag) {
                return redirect()->back()->with(['error' => 'هذا القسم غير موجود']);
            }


            DB::beginTransaction();
            $tag->update($request->except('token', 'id'));
//save translation://
            $tag->name = $request->name;
            $tag->save();
            DB::commit();

            return redirect()->route('dashboard.tags')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            return $ex;
            DB::rollBack();
            return redirect()->back()->with(['error' => 'خطأ في تجديث البيانات']);
        }

    }
    public function destroy($id)
    {
        $tag = Tag::find($id);
        if (!$tag) {
            return redirect()->back()->with(['error' => 'هذا القسم غير موجود']);

        }
        $tag->delete();
        return redirect()->route('dashboard.tags')->with(['success' => 'تم الحذف بنجاح']);


    }




}
