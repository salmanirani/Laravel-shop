<?php

namespace App\Http\Controllers\Backend;

use App\AttributeGroup;
use App\Http\Requests\MtcategoriesRequest;
use App\Mtcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Mtcategory::with('childrenReqursive')
            ->where('parent_id', null)
            ->paginate('10');
        return view('admin.mtcategories.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        die('ok');
        $categories = Mtcategory::with('childrenReqursive')
            ->where('parent_id', null)
            ->get();
        // return $categories;
        return view('admin.mtcategories.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MtcategoriesRequest $request)
    {
        $category = new Mtcategory();
        $category->name = $request->input('name');
        if (str_slug($request->input('slug'))) {
            $category->slug  = str_slug($request->input('slug'));

        } else {
            $category->slug  = str_slug($request->input('name'));
        }
        $category->parent_id = $request->input('category_parent');
        $category->meta_dc = $request->input('meta_description');
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->save();
        Session::flash('add_category', 'دسته بندی جدید با موفقیت ایجاد شد');
        return redirect('admin/mtcategories');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Mtcategory::with('childrenReqursive')
            ->where('parent_id', null)
            ->get();
        $category = Mtcategory::findOrFail($id);
        return view('admin.mtcategories.edit', compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(MtcategoriesRequest $request, $id)
    {
        $category = Mtcategory::findOrFail($id);
        $category->name = $request->input('name');
        if (str_slug($request->input('slug'))) {
            $category->slug  = str_slug($request->input('slug'));

        } else {
            $category->slug  = str_slug($request->input('name'));
        }
        $category->parent_id = $request->input('category_parent');
        $category->meta_dc = $request->input('meta_description');
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->save();
        Session::flash('add_category', 'دسته بندی جدید با موفقیت ویرایش شد');
        return redirect('admin/mtcategories');

    }


    public function destroy($id)
    {
        $category = Mtcategory::with('childrenReqursive')->where('id', $id)->first();
        $num = count($category->childrenReqursive);
        if ($num > 0) {
            Session::flash('category_delete', 'دسته بندی دارای زیر مجموعه میباشد و قابل حذف نیست.ابتدا زیر مجموعه را پاک کنید' );
            return redirect('admin/mtcategories');
        }
        $category->delete();
        Session::flash('add_category', 'دسته بندی ها با موفقیت حذف شد');
        return redirect('admin/mtcategories');
    }


    public function deleteAll(Request $request)
    {
        $categories = Mtcategory::findOrFail($request->checkBoxArray);
        foreach ($categories as $category) {
            $category->delete();

        }
        Session::flash('add_category', 'دسته بندی ها با موفقیت حذف شد');
        return redirect('admin/mtcategories');


    }


    public function indexSettings($id)
    {
        $category = Mtcategory::findOrFail($id);
        $attributeGroups = AttributeGroup::all();
        return view('admin.mtcategories.index-setting', compact(['category','attributeGroups']));

    }
    public function saveSettings(Request $request,$id)
    {
        $category = Mtcategory::findOrFail($id);
        $category->attributeGroups()->sync($request->attributeGroups);
        $category->save();

        return redirect('admin/mtcategories');

    }

    public function apiIndex()
    {
        $categories = Mtcategory::with('childrenReqursive')
            ->where('parent_id', null)
            ->get();
        $response = [
            'categories' => $categories
        ];
        return response()->json($response,'200');
    }
    public function apiIndexAttribute($id)
    {

        $mtcategories = explode(',',$id);
        $attributegroup = AttributeGroup::with('attributesvalue','mtcategories')
            ->whereHas('mtcategories',function ($q) use($mtcategories){
            $q->whereIn('mtcategories.id',$mtcategories);
        })->get();
        $response = [
            'attributes' => $attributegroup
        ];
        return response()->json($response,'200');
    }
}
