<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\CommentRequest;
use App\Mtcomment;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MtcommentController extends Controller
{

    public function store(CommentRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);
        if ($product) {
            $comment = new Mtcomment();
            $comment->description = $request->input('description');
            $comment->product_id = $productId;
            $comment->user_id = Auth::id();
            $comment->status = 0;
            $comment->save();
        }
        Session::flash('comments_status', 'نظر با موفقیت ثبت شد و در صف تایید قرار گرفت');
        return back();
    }
    public function reply(CommentRequest $request)
    {

        $productId = $request->input('product_id');
        $parentId = $request->input('parent_id');

        $product = Product::findOrFail($productId);
        if ($product) {
            $comment = new Mtcomment();
            $comment->description = $request->input('description');
            $comment->parent_id = $parentId;
            $comment->product_id = $productId;
            $comment->user_id = Auth::id();
            $comment->status = 0;
            $comment->save();
        }

        Session::flash('comments_status', 'نظر با موفقیت ثبت شد و در صف تایید قرار گرفت');
        return back();
    }

}
