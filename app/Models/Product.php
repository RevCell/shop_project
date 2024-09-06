<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
      return $this->belongsTo(category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function discount()
    {
        return $this->hasOne(discount::class);
    }

    public function final_price()
    {
        if ($this->discount()->exists())
        {
            return $this->price - $this->price * $this->discount->amount / 100;
        }
        else
        {
            return $this->price;
        }
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function gallery()
    {
        return $this->hasMany(Product_gallery::class,'product_id');
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class)
            ->withPivot(["content"])
            ->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class,'likes')
            ->withTimestamps();
    }

    public function like_chk()
    {
        return $this->likes()->where("user_id",auth()->id())->exists();
    }

    public function carts()
    {
        return $this->belongsToMany(User::class,'carts')
            ->withTimestamps();
    }

    public function cart_chk()
    {
        return $this->carts()->where("user_id",auth()->id())->exists();
    }

    public function cart_content()
    {
        return $this->hasOne(Cart::class);
    }


}
