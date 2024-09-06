<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\FeaturedCat;
use App\Models\Product;
use Illuminate\Http\Request;

class home extends Controller
{
    public function homepage()
    {
        return view("client.home",
        [
            'featured_cat'=>FeaturedCat::query()->first()->category,
        ]
        );
    }

}
