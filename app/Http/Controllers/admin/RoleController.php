<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\role_create_rules;
use App\Http\Requests\role_update_rules;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (Gate::denies("role_read"))
        {
            abort(403);
        }
        return view("admin.role.index",
        [
            'roles'=>Role::all()
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
        if (Gate::denies("role_create"))
        {
            abort(403);
        }
        return view("admin.role.create",
        [
            'permissions'=>Permission::all()
        ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(role_create_rules $data)
    {
        if (Gate::denies("role_create"))
        {
            abort(403);
        }
        $role=Role::query()->create(
            [
                'title'=>$data->get("title")
            ]
        );

        $role->permissions()->attach($data->get("permission"));

        return redirect(Route("role.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Role $role)
    {
        if (Gate::denies("role_update",$role))
        {
            abort(403);
        }
        return view("admin.role.edit",
        [
            'role'=>$role,
            'permissions'=>Permission::all()
        ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(role_update_rules $data, Role $role)
    {
        if (Gate::denies("role_update",$role))
        {
            abort(403);
        }
        $role->update(
            [
                'title'=>$data->get("title")
            ]
        );

        $role->permissions()->sync($data->get("permission"));

        return redirect(Route("role.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Role $role)
    {
        if (Gate::denies("role_delete"))
        {
            abort(403);
        }
        $role->permissions()->detach();
        $role->delete();
        return redirect(Route("role.index"));
    }
}
