<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\brand_create_rules;
use App\Http\Requests\brand_update_rules;
use App\Http\Requests\update_brand_rules;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (Gate::denies("brand_read"))
        {
            abort(403);
        }
        return view("admin/brand/index",
        [
            'brands'=>Brand::all()
        ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create()
    {
        if (Gate::denies("brand_create"))
        {
            abort(403);
        }
        return view("admin/brand/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(brand_create_rules $data)
    {
        if (Gate::denies("brand_create"))
        {
            abort(403);
        }

        $img=$data->file('image')
            ->storeAs('public/brand_img',
            $data->get('title')
            .rand()
            .$data->file('image')->getClientOriginalName());

        Brand::query()->create(
            [
                'title'=>$data->get("title"),
                'image'=>$img
            ]
        );

        return redirect(Route("brand.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Brand $brand)
    {
        if (Gate::denies("brand_update",$brand))
        {
            abort(403);
        }

        return view("admin.brand.edit",
        [
            'brand'=>$brand
        ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(brand_update_rules $data, Brand $brand)
    {
        if (Gate::denies("brand_update",$brand))
        {
            abort(403);
        }

        $title_chk=Brand::query()
            ->where('title',$data->get("title"))
            ->where('id','!=',$brand->id)
            ->exists();

        if ($title_chk)
        {
            return back()->withErrors("the title you entered has already been assign to another Brand, try a new one");
        }

        if ($data->hasFile('image'))
        {
            $img=$data->file("image")
                ->storeAs("public/brand_img",
                    'e_'
                    .$data->get("title")
                    .$data->file("image")->getClientOriginalName());
        }
        else
        {
            $img=$brand->image;
        }

        $brand->update(
            [
                'title'=>$data->get("title"),
                'image'=>$img
            ]
        );


        return redirect(Route("brand.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Brand $brand)
    {
        if (Gate::denies("brand_delete"))
        {
            abort(403);
        }

        storage::delete($brand->image);
        $brand->delete();
        return redirect(Route("brand.index"));
    }
}
