<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\gallery_create_rules;
use App\Models\Product;
use App\Models\Product_gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductGalleryController extends Controller
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
        if (Gate::denies("gallery_create"))
        {
            abort(403);
        }
        return view("admin.gallery.create",
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
    public function store(gallery_create_rules $data, Product $product)
    {
        if (Gate::denies("gallery_create"))
        {
            abort(403);
        }
        $img_address=$data->file('address')
            ->storeAs("public/product_img/gallery"
            ,rand()
            .$data->file("address")->getClientOriginalName());

        $img_extension=$data->file('address')->getClientMimeType();

        Product_gallery::query()->create(
            [
                'product_id'=>$product->id,
                'address'=>$img_address,
                'extension'=>$img_extension
            ]
        );

        return redirect(Route("gallery.create",$product));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product_gallery  $product_gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Product_gallery $product_gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product_gallery  $product_gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_gallery $product_gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product_gallery  $product_gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_gallery $product_gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product_gallery  $product_gallery
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Product_gallery $product_gallery, Product $product)
    {
        if (Gate::denies("gallery_delete"))
        {
            abort(403);
        }
        storage::delete($product_gallery->address);

        $product_gallery->delete();

        return redirect(Route("gallery.create",$product));
    }
}
