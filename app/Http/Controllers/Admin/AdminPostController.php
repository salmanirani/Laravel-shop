<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostEditRequest;
use App\Photo;
use App\Post;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('photo', 'category', 'user')->where('user_id',Auth::id())->paginate(10);
        $counter = 1;
        return view('admin.posts.index', compact(['posts']))->withCounter($counter);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $categories = Category::pluck('title','id');
        $categories = Category::all('title', 'id');
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        // dd(str_slug($request->input('title')));
        $post = new Post();
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
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->meta_description = $request->input('meta_description');
        $post->meta_keywords = $request->input('meta_keywords');
        $post->category_id = $request->input('category');
        $post->status = $request->input('status');
        $post->user_id = Auth::id();

        if ($request->input('slug')) {
            $post->slug = str_slug($request->input('slug'));

        } else {
            $post->slug = str_slug($request->input('title'));
        }


        $post->save();

        $users = User::with('roles')->get();
        Session::flash('add_post', 'مطلب جدید با موفقیت ایجاد شد');

        return redirect('admin/posts');
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
        $categories = Category::all('title', 'id');
        $post = Post::findOrFail($id);
        //dd($categories[0]['title']);
        return view('admin.posts.edit', compact(['post', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostEditRequest $request, $id)
    {
        $post = Post::findOrFail($id);
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

        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->meta_description = $request->input('meta_description');
        $post->meta_keywords = $request->input('meta_keywords');
        $post->category_id = $request->input('category');
        $post->status = $request->input('status');
        $post->user_id = Auth::id();

        if ($request->input('slug')) {
            $post->slug = str_slug($request->input('slug'));

        } else {
            $post->slug = str_slug($request->input('title'));
        }


        $post->save();

        Session::flash('add_post', 'پست با موفقیت ویرایش شد');

        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        //if (!empty($post->photo_id)) {
        $photo = Photo::findOrFail($post->photo_id);
        unlink('./' . $photo->path);
        $photo->delete();
        // dd($photo);
        //}

        $post->delete();
        Session::flash('delete_user', 'کاربر با موفقیت حذف شد');
        return redirect('admin/posts');
    }

    public function deleteAll(Request $request)
    {
        $posts = Post::findOrFail($request->checkBoxArray);
        foreach ($posts as $post){
            unlink('./' . $photo->path);
            $post->delete();

        }
        Session::flash('add_post', 'پست ها با موفقیت حذف شد');
        return back();


    }
}
