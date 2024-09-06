<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\prop_group_create_rules;
use App\Http\Requests\prop_group_update_rules;
use App\Models\property_group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PropertyGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (Gate::denies("property_group_read"))
        {
            abort(403);
        }
        return view("admin.property_group.index",
            [
                'properties'=>property_group::all()
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
        if (Gate::denies("property_group_create"))
        {
            abort(403);
        }
        return view("admin.property_group.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(prop_group_create_rules $data)
    {
        if (Gate::denies("property_group_create"))
        {
            abort(403);
        }
        property_group::query()->create(
            [
                'title'=>$data->get('title')
            ]
        );
        return redirect(Route("property_g.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\property_group  $property_group
     * @return \Illuminate\Http\Response
     */
    public function show(property_group $property_group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\property_group  $property_group
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(property_group $property_group)
    {
        if (Gate::denies("property_group_update",$property_group))
        {
            abort(403);
        }
        return view("admin/property_group/edit",
            [
                "property"=>$property_group
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\property_group  $property_group
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(prop_group_update_rules $data, property_group $property_group)
    {
        if (Gate::denies("property_group_update",$property_group))
        {
            abort(403);
        }
        $property_group->update(
            [
                'title'=>$data->get("title")
            ]
        );
        return redirect(Route("property_g.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\property_group  $property_group
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(property_group $property_group)
    {
        if (Gate::denies("property_group_delete"))
        {
            abort(403);
        }
        $property_group->delete();
        return redirect(Route("property_g.index"));
    }
}
