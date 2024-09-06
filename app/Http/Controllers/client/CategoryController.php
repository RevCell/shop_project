<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(category $category)
    {
        return view("client.category.index",
        ['categories'=>$category]
        );
    }
}
