<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Photo;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(7);
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category();
        $category->title = $request->input('title');
        $category->meta_description = $request->input('meta_description');
        $category->meta_keywords = $request->input('meta_keywords');
        if ($request->input('slug')) {
            $category->slug = str_slug($request->input('slug'));
        } else {
            $category->slug = str_slug($request->input('title'));
        }
        $category->save();
        Session::flash('add_category', 'دسته بندی جدید با موفقیت ایجاد شد');
        return redirect('admin/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::findOrFail($id);
        //dd($categories[0]['title']);
        return view('admin.categories.edit', compact([ 'categories']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
      $category = Category::findOrFail($id);
        $category->title = $request->input('title');
        $category->meta_description = $request->input('meta_description');
        $category->meta_keywords = $request->input('meta_keywords');

        if ($request->input('slug')) {
            $category->slug = str_slug($request->input('slug'));

        } else {
            $category->slug = str_slug($request->input('title'));
        }


        $category->save();

        Session::flash('add_category', 'پست با موفقیت ویرایش شد');

        return redirect('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        //if (!empty($post->photo_id)) {


        $category->delete();
        Session::flash('category_delete', 'دسته بندی با موفقیت حذف شد');
        return redirect('admin/categories');
    }
    public function deleteAll(Request $request)
    {
        $categories = Category::findOrFail($request->checkBoxArray);
        foreach ($categories as $category){
//            unlink(public_path() . $photo->path);
            $category->delete();

        }
        Session::flash('add_category', 'دسته بندی ها با موفقیت حذف شد');
        return back();


    }
}
