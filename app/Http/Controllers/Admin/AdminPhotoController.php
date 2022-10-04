<?php

namespace App\Http\Controllers\Admin;

use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AdminPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::with(['user'])->where('user_id',Auth::id())->paginate(10);
        return view('admin.photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.photos.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $name = time() . $file->getClientOriginalName();
        $file->move('images', $name);
        $photo = new Photo();
        $photo->name = $file->getClientOriginalName();
        $photo->path = $name;
        $photo->user_id = Auth::id();
        $photo->save();
        $post->photo_id = $photo->id;

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $photo = Photo::findOrFail($id);
        $photo = Photo::where('name', '=', $id)->first();;
        unlink('./' . $photo->path);
        $photo->delete();
        Session::flash('photos_delete', 'تصویر با موفقیت حذف شد');
        return redirect('admin/photos');
    }

    public function deleteAll(Request $request)
    {
        $photos = Photo::findOrFail($request->checkBoxArray);
        foreach ($photos as $photo) {
            unlink('./' . $photo->path);
            $photo->delete();

        }
        Session::flash('photos_delete', 'فایل ها با موفقیت حذف شد');
        return back();


    }

}
