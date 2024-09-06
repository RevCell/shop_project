<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\product_create_rules;
use App\Http\Requests\product_update_rules;
use App\Models\Brand;
use App\Models\category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (Gate::denies("product_read"))
        {
            abort(403);
        }
        return view("admin.product.index",
        [
            'products'=>Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        if (Gate::denies("product_create"))
        {
            abort(403);
        }
        return view("admin.product.create",
        [
            'category'=>category::all(),
            'brand'=>Brand::all()
        ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(product_create_rules $data)
    {
        if (Gate::denies("product_create"))
        {
            abort(403);
        }
        $img=$data->file("image")
            ->storeAs("public/product_img/cover",
            $data->get("title")
                .rand()
                .$data->file('image')->getClientOriginalName());

        Product::query()->create(
            [
                'category_id'=>$data->get("category_id"),
                'brand_id'=>$data->get("brand_id"),
                'title'=>$data->get("title"),
                'price'=>$data->get("price"),
                'slug'=>$data->get("slug"),
                'image'=>$img,
                'description'=>$data->get("description"),
            ]
        );

        return redirect(Route('product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        if (Gate::denies("product_update",$product))
        {
            abort(403);
        }
        return view("admin.product.edit",
        [
            'category'=>category::all(),
            'brand'=>Brand::all(),
            'product'=>$product
        ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(product_update_rules $data, Product $product)
    {
        if (Gate::denies("product_update",$product))
        {
            abort(403);
        }
        $slug_chk=Product::query()
            ->where('slug',$data->get("slug"))
            ->where("id",'!=',$product->id)
            ->exists();
        if ($slug_chk)
        {
            return back()->withErrors("the slug you've entered has already been used for another product");
        }

        if ($data->hasFile('image'))
        {
            $img=$data->file("image")
                ->storeAs('public/product_img/cover'
                ,"e_"
                    .$data->get("title")
                    .$data->file("image")->getClientOriginalName()
                );
        }
        else
        {
            $img=$product->image;
        }

        $product->update(
            [
                'category_id'=>$data->get("category_id"),
                'brand_id'=>$data->get("brand_id"),
                'title'=>$data->get("title"),
                'price'=>$data->get("price"),
                'slug'=>$data->get("slug"),
                'image'=>$img,
                'description'=>$data->get("description"),
            ]
        );

        return redirect(Route('product.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Product $product)
    {
        if (Gate::denies("product_delete"))
        {
            abort(403);
        }
        storage::delete($product->image);
        $product->delete();
        return redirect(Route('product.index'));
    }
}
