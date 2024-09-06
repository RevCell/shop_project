<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class dashboard extends Controller
{
    //-------------------------------------------------------------------
    public function dashboard()
    {
        if (Gate::denies("admin_dashboard_read"))
        {
            abort(403);
        }
        return view("admin.dashboard");
    }
    //-------------------------------------------------------------------

}
