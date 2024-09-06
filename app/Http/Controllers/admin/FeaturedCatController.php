<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\FeaturedCat;
use http\Env\Request;
use Illuminate\Support\Facades\Gate;

class FeaturedCatController extends Controller
{
    public function create()
    {
        if (Gate::denies("featured_menu_create"))
        {
            abort(403);
        }
        $featured=FeaturedCat::query()->first();
        return view("admin.featured_cat.create",
            [
                'featured'=>$featured,
                'featuredcats'=>category::query()->where("category_id",null)->get()
            ]
        );



    }

    public function store(\Illuminate\Http\Request $data)
    {
        if (Gate::denies("featured_menu_delete"))
        {
            abort(403);
        }
        FeaturedCat::query()->delete();

        FeaturedCat::query()->create(
            [
                'category_id'=>$data->get("category_id")
            ]
        );
        return redirect(Route("admin_dashboard"));
    }
}
