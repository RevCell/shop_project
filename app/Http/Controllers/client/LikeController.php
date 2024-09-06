<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use http\Client\Curl\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $data, Product $product)
    {
        auth()->user()->likes()->attach($product);
        return back();
    }

    public function de_store(Product $product)
    {
        auth()->user()->likes()->detach($product);
        return back();
    }

    public function index()
    {
        return view("client.wishlist.index",
        [
            'products'=>auth()->user()->likes
        ]
        );
    }
}
