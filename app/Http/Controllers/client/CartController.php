<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{

    public function index()
    {
        return view('client.cart.index',
        [
            'product'=>auth()->user()->carts,
            'total_price'=>auth()->user()->carts()->sum("product_price"),
        ]
        );
    }

    public function store(Request $request,Product $product)
    {
        $user=auth()->user();
        Cart::query()->create(
            [
                'amount'=>$request->get("amount"),
                'product_price'=>($request->get("amount")*$product->final_price()),
                'product_id'=>$request->get("product_id"),
                'user_id'=>$user->id

            ]
        );

        return back();
    }

    public function update(Request $request,Product $product)
    {

        $product->carts()->update(
            [
                'amount'=>$request->get("amount"),
                'product_price'=>($request->get("amount")*$product->final_price()),
            ]
        );

        return back();
    }

    public function destroy(Product $product)
    {
        auth()->user()->carts()->detach($product);
        return back();
    }
}
