<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\category_create_rules;
use App\Http\Requests\category_update_rules;
use App\Models\category;
use App\Models\property_group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (Gate::denies("category_read"))
        {
            abort(403);
        }
        return view("admin.category.index",
        [
            'categories'=>category::all()
        ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        if (Gate::denies("category_create"))
        {
            abort(403);
        }
        return view("admin.category.create",
            [
                'categories'=>category::all(),
                'properties'=>property_group::all()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(category_create_rules $data)
    {
        if (Gate::denies("category_create"))
        {
            abort(403);
        }
        $cat=category::query()->create(
            [
                'title'=>$data->get('title'),
                'category_id'=>$data->get('category_id')
            ]
        );

        $cat->property_groups()->attach($data->get('prop_group'));
        return redirect(Route("category.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(category $category)
    {
        if (Gate::allows("category_update",$category))
        {
            abort(403);
        }
        return view("admin/category/edit",
        [
            "category"=>$category,
            "categories"=>category::all(),
            'properties'=>property_group::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(category_update_rules $data, category $category)
    {
        if (Gate::allows("category_update",$category))
        {
            abort(403);
        }
        $cat_chk=category::query()
            ->where('title',$data->get("title"))
            ->where('id','!=',$category->id)
            ->exists();

        if ($cat_chk)
        {
            return
                redirect()
                ->back()
                ->withErrors("the title you entered has already been assign to another category, try a new one");
        }
        $category->update(
            [
                'title'=>$data->get("title"),
                'category_id'=>$data->get("category_id")
            ]
        );

        $category->property_groups()->sync($data->get('prop_group'));
        return redirect(Route("category.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(category $category)
    {
        if (Gate::denies("category_delete"))
        {
            abort(403);
        }
        if ($category->parent_category->count() > 0)
        {
            return redirect()->back()->withErrors("you cant remove a parent category, try to remove it's children categories first");
        }

        $category->property_groups()->detach();

        $category->delete();
        return redirect(Route("category.index"));
    }
}
