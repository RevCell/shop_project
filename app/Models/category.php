<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    protected $guarded= [];

    public function parent_category()
    {
        return $this->hasMany(category::class,'category_id');
    }

    public function child_category()
    {
        return $this->belongsTo(category::class,"category_id");
    }

    public function allProducts()
    {
        $sub_cats=$this->parent_category()->pluck("id");

        return Product::query()->whereIn("category_id",$sub_cats)
            ->orWhere('category_id',$this->id)
            ->get();
    }

    public function property_groups()
    {
        return $this->belongsToMany(property_group::class);
    }

    public function prop_group_check(property_group $props)
    {
       return $this->property_groups()
       ->where("id",$props->id)
       ->exists();
    }

}
