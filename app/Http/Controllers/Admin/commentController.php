<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Comment;
use App\Http\Requests\PostEditRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class commentController extends Controller
{
    public function index()
    {
        $comments = Comment::orderBy('created_at','desc')
            ->paginate('20');
        return view('admin.comments.index', compact('comments'));

    }


    public function actions(Request $request,$id)
    {
       //
        if($request->input('action')=='approved'){
            $comment =Comment::findOrFail($id);
            $comment->status = 1;
            $comment->save();
        }
        if($request->input('action')=='rejected'){
            $comment =Comment::findOrFail($id);
            $comment->status = 0;
            $comment->save();
        }
        Session::flash('comments_status', 'نظر کاربر با موفقیت تغییر یافت');
        return redirect('admin/comments');

    }


    public function edit($id)
    {
       $comments = Comment::findOrFail($id);
       return view('admin.comments.edit',compact('comments'));
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
        $comments = Comment::findOrFail($id);
        $comments->description = $request->input('descriotion');
        $comments->save();
        Session::flash('comments_status', 'نظر با موفقیت ویرایش شد');

        return redirect('admin/comments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comments = Comment::findOrFail($id);


        $comments->delete();
        Session::flash('comment_delete', 'نظر با موفقیت حذف شد');
        return redirect('admin/comments');
    }
    public function deleteAll(Request $request)
    {
        $comments = Comment::findOrFail($request->checkBoxArray);
        foreach ($comments as $comment){
//            unlink(public_path() . $photo->path);
            $comment->delete();

        }
        Session::flash('comments_status', 'نظرات ها با موفقیت حذف شد');
        return back();


    }
}
