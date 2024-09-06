<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\profile_update_rules;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{
    public function show()
    {
        if (Gate::denies("profile_read")){
            abort(403);
        }
       return view("admin.profile.edit",
       [
           'user'=>auth()->user()
       ]
       );
    }

    public function update(profile_update_rules $data,User $user)
    {
        if (Gate::denies("profile_update")){
            abort(403);
        }
        $user->update(
            [
                'name'=>$data->get("name"),
                'email'=>$data->get("email")
            ]
        );
        return redirect(route("admin_dashboard"));
    }
}
