<?php

namespace App\Http\Controllers\Backend;

use App\Mtcomment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class MtcommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Mtcomment::with('product')->orderBy('created_at','desc')
            ->paginate('20');
        return view('admin.mtcomments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function actions(Request $request,$id)
    {
        //
        if($request->input('action')=='approved'){
            $comment =Mtcomment::findOrFail($id);
            $comment->status = 1;
            $comment->save();
        }
        if($request->input('action')=='rejected'){
            $comment =Mtcomment::findOrFail($id);
            $comment->status = 0;
            $comment->save();
        }
        Session::flash('comments_status', 'نظر کاربر با موفقیت تغییر یافت');
        return redirect('admin/mtcomments');

    }


    public function edit($id)
    {

        $comments = Mtcomment::findOrFail($id);
        return view('admin.mtcomments.edit',compact('comments'));
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
        $comments = Mtcomment::findOrFail($id);
        $comments->description = $request->input('descriotion');
        $comments->save();
        Session::flash('comments_status', 'نظر با موفقیت ویرایش شد');

        return redirect('admin/mtcomments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comments = Mtcomment::findOrFail($id);


        $comments->delete();
        Session::flash('comment_delete', 'نظر با موفقیت حذف شد');
        return redirect('admin/mtcomments');
    }
    public function deleteAll(Request $request)
    {
        $comments = Mtcomment::findOrFail($request->checkBoxArray);
        foreach ($comments as $comment){
//            unlink(public_path() . $photo->path);
            $comment->delete();

        }
        Session::flash('comments_status', 'نظرات ها با موفقیت حذف شد');
        return back();


    }
}
