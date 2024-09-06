<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\comment_create_rules;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(comment_create_rules $data,Product $product)
    {
        Comment::query()->create(
            [
                'product_id'=>$product->id,
                'user_id'=>'1',
                'content'=>$data->get("content"),
                'status'=>'0'
            ]
        );
        return back();
    }
}
