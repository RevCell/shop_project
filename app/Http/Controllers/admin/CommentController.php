<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function index(Product $product)
    {
        if (Gate::denies("comment_read"))
        {
            abort(403);
        }
        return view("admin.comment.index",
        [
            'product'=>$product
        ]
        );
    }

    public function edit(Comment $comment ,Product $product)
    {
        return view("admin.comment.edit",
            [
                'product'=>$product,
                'comment'=>$comment
            ]
        );
    }


    public function update(Comment $comment ,Product $product)
    {
        $comment->update(
            [
                'product_id'=>$product->id,
                'user_id'=>'1',
                'content'=>$comment->get("content"),
                'status'=>$comment->get("status")
            ]
        );
        return redirect("product.index");
    }


    public function destroy(Comment $comment )
    {
        if (Gate::denies("comment_delete"))
        {
            abort(403);
        }
        $comment->delete();
        return back();
    }
}
