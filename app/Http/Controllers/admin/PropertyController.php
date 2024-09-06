<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\prop_create_rules;
use App\Http\Requests\prop_update_rules;
use App\Models\Property;
use App\Models\property_group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (Gate::denies("property_read"))
        {
            abort(403);
        }
        return view("admin.property.index",
            [
                'properties'=>Property::all()
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
        if (Gate::denies("property_create"))
        {
            abort(403);
        }
        return view("admin.property.create",
        [
            'prop_group'=>property_group::all()
        ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(prop_create_rules $data)
    {
        if (Gate::denies("property_create"))
        {
            abort(403);
        }
        Property::query()->create(
            [
                'title'=>$data->get('title'),
                'property_group_id'=>$data->get("prop_group")
            ]
        );
        return redirect(Route("property.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Property $property)
    {
        if (Gate::denies("property_update",$property))
        {
            abort(403);
        }
        return view("admin/property/edit",
            [
                "property"=>$property,
                'properties'=>property_group::all()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(prop_update_rules $data, Property $property)
    {
        if (Gate::denies("property_update",$property))
        {
            abort(403);
        }
        $property->update(
            [
                'title'=>$data->get("title"),
                'property_group_id'=>$data->get("prop_group")
            ]
        );
        return redirect(Route("property.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Property $property)
    {
        if (Gate::denies("property_delete",$property))
        {
            abort(403);
        }
        $property->delete();
        return redirect(Route("property.index"));
    }
}
