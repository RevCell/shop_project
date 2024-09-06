<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function property_group()
    {
        return $this->belongsTo(property_group::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(["content"])
            ->withTimestamps();
    }

    public function default_content(Product $product)
    {
        $default=$this->products()->where("product_id",$product->id);

        if ($default->exists())
        {
            return $default->first()->pivot->content;
        }
        else
        {
            return null;
        }
    }
}
