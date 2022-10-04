<?php

namespace App\Http\Controllers\Frontend;

use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class commentController extends Controller
{
    public function store(CommentRequest $request, $postId)
    {
        $post = Post::findOrFail($postId);
        if ($post) {
            $comment = new Comment();
            $comment->description = $request->input('description');
            $comment->post_id = $postId;
            $comment->status = 0;
            $comment->user_id = Auth::id();
            $comment->save();
        }
        Session::flash('comments_status', 'نظر با موفقیت ثبت شد و در صف تایید قرار گرفت');
        return back();

    }

    public function reply(CommentRequest $request)
    {

        $postId = $request->input('post_id');
        $parentId = $request->input('parent_id');
       // dd($postId);
        $post = Post::findOrFail($postId);

        if ($post) {
            $comment = new Comment();
            $comment->description = $request->input('description');
            $comment->parent_id = $parentId;
            $comment->post_id = $postId;
            $comment->status = 0;
            $comment->user_id = Auth::id();
            $comment->save();
        }
        Session::flash('comments_status', 'نظر با موفقیت ثبت شد و در صف تایید قرار گرفت');
        return back();
    }
}
