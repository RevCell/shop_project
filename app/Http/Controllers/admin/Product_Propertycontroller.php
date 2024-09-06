<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class Product_Propertycontroller extends Controller
{
    public function index(Product $product)
    {
        return view("admin.product_property.index",
        [
            'product'=>$product
        ]
        );
    }

    public function create(Product $product)
    {
        $property_groups=$product->category->property_groups;
        return view("admin.product_property.create",
            [
                'product'=>$product,
                'property_groups'=>$property_groups
            ]
        );
    }

    public function store(Request $data,Product $product)
    {
        $raw_data=collect($data->get("property"))->filter(function ($content)
        {
            if (!empty($content['content']))
            {
                return $content;
            }
        });


        $product->properties()->sync($raw_data);
        return view("admin.product_property.index",
            [
                'product'=>$product
            ]
        );
    }
}
