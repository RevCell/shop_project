<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\discount_create_rules;
use App\Models\discount;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Product $product)
    {
        if (Gate::denies("offer_create"))
        {
            abort(403);
        }
        return view("admin.discount.create",
        [
            'product'=>$product
        ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(discount_create_rules $data, Product $product)
    {
        if (Gate::denies("offer_create"))
        {
            abort(403);
        }
        $product->discount()->create(
            [
                'amount'=>$data->get("amount"),
                'product_id'=>$data->get("product_id")
            ]
        );

        return redirect(Route("product.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(discount $discount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, discount $discount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\discount  $discount
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(discount $discount,Product $product)
    {
        if (Gate::denies("offer_delete"))
        {
            abort(403);
        }
        $discount->delete();
        return redirect(Route("product.index"));
    }
}
