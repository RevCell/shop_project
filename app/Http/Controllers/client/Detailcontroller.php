<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Product;
use Illuminate\Http\Request;

class Detailcontroller extends Controller
{
    public function show(Product $pros)
    {
       $property_groups=$pros->category->property_groups;
       return view("client.product_detail.show",
       [
           'product'=>$pros,
           'property_g'=>$property_groups
       ]
       );
    }
}
