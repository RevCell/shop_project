<?php

namespace App\Models;

use App\Http\Requests\cart_store_rules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Self_;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function get_cart()
    {
         return auth()->user()->carts;
    }

    public static function get_totalprice()
    {
        return auth()->user()->carts()->sum("product_price");
    }

    public static function get_totalproduct()
    {
        return auth()->user()->carts()->sum("amount");
    }



}




