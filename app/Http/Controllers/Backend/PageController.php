<?php

namespace App\Http\Controllers\Backend;

use App\Page;
use App\Photo;
use App\Shop;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::with('photo', 'user')->where('user_id',Auth::id())->paginate(10);
        $counter = 1;
        return view('admin.pages.index', compact(['pages']))->withCounter($counter);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shops = Shop::where('user_id',Auth::id())->get();
        return view('admin.pages.create', compact(['shops']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Page();
        if ($file = $request->file('first_photo')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = new Photo();
            $photo->name = $file->getClientOriginalName();
            $photo->path = $name;
            $photo->user_id = Auth::id();
            $photo->save();
            $post->photo_id = $photo->id;
        }
        $post->shop_id = $request->input('shop_id');
        $post->name = $request->input('name');
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->meta_description = $request->input('meta_description');
        $post->meta_keywords = $request->input('meta_keywords');
        $post->status = $request->input('status');
        $post->user_id = Auth::id();

        if ($request->input('slug')) {
            $post->slug = str_slug($request->input('slug'));

        } else {
            $post->slug = str_slug($request->input('title'));
        }


        $post->save();


        Session::flash('add_post', 'مطلب جدید با موفقیت ایجاد شد');

        return redirect('admin/pages');
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
        $post = Page::findOrFail($id);
        //dd($categories[0]['title']);
        $shops = Shop::where('user_id',Auth::id())->get();

        return view('admin.pages.edit', compact(['post','shops']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Page::findOrFail($id);
        if ($file = $request->file('first_photo')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = new Photo();
            $photo->name = $file->getClientOriginalName();
            $photo->path = $name;
            $photo->user_id = Auth::id();
            $photo->save();
            $post->photo_id = $photo->id;
        }

        $post->shop_id = $request->input('shop_id');
        $post->name = $request->input('name');
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->meta_description = $request->input('meta_description');
        $post->meta_keywords = $request->input('meta_keywords');
        $post->status = $request->input('status');
        $post->user_id = Auth::id();

        if ($request->input('slug')) {
            $post->slug = str_slug($request->input('slug'));

        } else {
            $post->slug = str_slug($request->input('title'));
        }


        $post->save();

        Session::flash('add_post', 'پست با موفقیت ویرایش شد');

        return redirect('admin/pages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Page::findOrFail($id);
        //if (!empty($post->photo_id)) {
        $photo = Photo::findOrFail($post->photo_id);
        unlink(public_path() . $post->photo->path);
        $photo->delete();
        // dd($photo);
        //}

        $post->delete();
        Session::flash('delete_user', 'کاربر با موفقیت حذف شد');
        return redirect('admin/pages');
    }

    public function deleteAll(Request $request)
    {
        $posts = Page::findOrFail($request->checkBoxArray);
        foreach ($posts as $post){
//            unlink(public_path() . $photo->path);
            $post->delete();

        }
        Session::flash('add_post', 'پست ها با موفقیت حذف شد');
        return back();


    }
}
